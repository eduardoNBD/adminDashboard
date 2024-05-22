<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\CustomModel;
use Illuminate\Support\Facades\DB;

class Selling extends CustomModel
{
    use HasFactory;
    use HasUuids;

    protected $table = 'sellings';
    public $keyType  = 'string';
    public $incrementing = false; 

    public static $status = [
        "Cancelada",
        "Pendiente de pago",
        "Pagado",
    ];

    public static function getStatus(){
        return self::$status;
    }

    public static function getTotalSellings()
    { 
        $rows = DB::select("SELECT 
                MONTHS.month,
                COALESCE(SUM(sellings.subtotal), 0) AS total
            FROM (
                SELECT MONTH(CURRENT_DATE()) - 3 AS month UNION ALL
                SELECT MONTH(CURRENT_DATE()) - 2 UNION ALL
                SELECT MONTH(CURRENT_DATE()) - 1 UNION ALL
                SELECT MONTH(CURRENT_DATE())
                
            ) AS MONTHS
            LEFT JOIN sellings ON MONTH(sellings.updated_at) = MONTHS.month
                AND sellings.updated_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 4 MONTH)
                AND sellings.status = 2
            GROUP BY MONTHS.month;");

        return $rows;
    }

    public static function getTotalSellingsWeek(){
        $rows = DB::select("SELECT
            user_id,
            users.username,
            CONCAT(users.name,' ',users.lastname) AS fullname,
            SUM(qty * price) AS total,
            DATE_ADD(DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE())) DAY), INTERVAL 6 DAY) AS endInteval,
            DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE())) DAY) AS beginInterval
        FROM (
            SELECT
                JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.users[', numbers.idx, ']'))) AS user_id,
                CAST(JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.qty[', numbers.idx, ']'))) AS DECIMAL(10,2)) AS qty,
                CAST(JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.price[', numbers.idx, ']'))) AS DECIMAL(10,2)) AS price,
                updated_at
            FROM sellings
            JOIN (
                SELECT 0 AS idx UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
            ) AS numbers
            WHERE JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.qty[', numbers.idx, ']'))) IS NOT NULL AND sellings.updated_at >= DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE())) DAY)
                AND sellings.updated_at < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE())) DAY), INTERVAL 6 DAY)
                AND sellings.status = 2
        ) AS detail_expanded
        INNER JOIN users ON users.id = user_id
        GROUP BY user_id, users.username, fullname
        ORDER BY total DESC LIMIT 5");

        return $rows;
    }

    public static function getTotalSellingsMonthsByUser($id){
        $rows = DB::select("SELECT 
            MONTHS.month, 
            COALESCE(SUM(detail_expanded.subtotal), 0) AS total
        FROM (
            SELECT MONTH(CURRENT_DATE()) - 3 AS month UNION ALL
            SELECT MONTH(CURRENT_DATE()) - 2 UNION ALL
            SELECT MONTH(CURRENT_DATE()) - 1 UNION ALL
            SELECT MONTH(CURRENT_DATE())
        ) AS MONTHS
        LEFT JOIN (
            SELECT
                s.subtotal,
                JSON_UNQUOTE(JSON_EXTRACT(s.detail, CONCAT('$.users[', numbers.idx, ']'))) AS user_id,
                s.updated_at,
                s.status
            FROM sellings s
            JOIN (
                SELECT 0 AS idx UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
                -- Ajusta según el número máximo de elementos en tus arrays
            ) AS numbers
            WHERE JSON_UNQUOTE(JSON_EXTRACT(s.detail, CONCAT('$.users[', numbers.idx, ']'))) IS NOT NULL
                 
        ) AS detail_expanded
        ON MONTH(detail_expanded.updated_at) = MONTHS.month
            AND detail_expanded.updated_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 4 MONTH)
            AND detail_expanded.status = 2
            AND detail_expanded.user_id = '".$id."' 
        GROUP BY MONTHS.month, detail_expanded.user_id
        ORDER BY MONTHS.month, detail_expanded.user_id;");

        return $rows;
    }

    public static function getTopProducts(){
        $rows = DB::select("SELECT
            product_id,
            SUM(item_qty) AS total_sold,
            products.name AS product_name,
            products.qty AS product_qty
        FROM (
            SELECT
                JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.items[', numbers.idx, ']'))) AS product_id,
                JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.types[', numbers.idx, ']'))) AS item_type,
                JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.qty[', numbers.idx, ']'))) AS item_qty,
                JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.users[', numbers.idx, ']'))) AS user_id, 
                updated_at
            FROM sellings
            JOIN (
                SELECT 0 AS idx UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4  
            ) AS numbers
            WHERE JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.items[', numbers.idx, ']'))) IS NOT NULL
            AND JSON_UNQUOTE(JSON_EXTRACT(detail, CONCAT('$.types[', numbers.idx, ']'))) = 'Productos'
            AND sellings.updated_at >= DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE())) DAY)
            AND sellings.updated_at < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE())) DAY), INTERVAL 7 DAY)
        ) AS detail_expanded
        INNER JOIN products ON products.id = detail_expanded.product_id
        GROUP BY product_id, products.name
        ORDER BY total_sold DESC
        LIMIT 5");

        return $rows;
    }
}
 

 