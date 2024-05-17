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
        ) AS detail_expanded
        INNER JOIN users ON users.id = user_id
        GROUP BY user_id, users.username, fullname
        ORDER BY total DESC LIMIT 5");

        return $rows;
    }
}
