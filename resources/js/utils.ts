function FormatDate(date:Date,format:String): string
{
    let strFormatDate = "";

    for(var i = 0; i < format.length; i++ )
    {
        switch(format[i].toLowerCase()){
            case "y":
                strFormatDate+= date.getFullYear();
            break;
            case "m": 
                strFormatDate+= date.getMonth() < 10 ? "0"+date.getMonth() : date.getMonth();
            break;
            case "d":
                strFormatDate+= date.getDay() < 10 ? "0"+date.getDay() : date.getDay();
            break;
            default:
                strFormatDate+=format[i];
            break
        }
    }

    return strFormatDate;
}