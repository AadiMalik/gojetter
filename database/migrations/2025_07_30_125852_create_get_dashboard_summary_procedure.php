<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS GetDashboardStats;

            CREATE PROCEDURE GetDashboardStats(IN type VARCHAR(20))
            BEGIN
                DECLARE startDate DATE;
                DECLARE endDate DATE;

                SET startDate = CURDATE();

                IF type = 'daily' THEN
                    SET endDate = startDate;
                ELSEIF type = 'weekly' THEN
                    SET startDate = DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY);
                    SET endDate = DATE_ADD(startDate, INTERVAL 6 DAY);
                ELSEIF type = 'monthly' THEN
                    SET startDate = DATE_SUB(CURDATE(), INTERVAL DAY(CURDATE()) - 1 DAY);
                    SET endDate = LAST_DAY(CURDATE());
                ELSEIF type = 'yearly' THEN
                    SET startDate = DATE_FORMAT(CURDATE(), '%Y-01-01');
                    SET endDate = DATE_FORMAT(CURDATE(), '%Y-12-31');
                END IF;

                -- 1st Result Set: Summary Counts
                SELECT 
    (SELECT COUNT(*) FROM users 
        WHERE email_verified_at IS NOT NULL 
          AND id IN (SELECT model_id FROM model_has_roles WHERE role_id = (SELECT id FROM roles WHERE name = 'user' LIMIT 1))
          AND created_at BETWEEN startDate AND endDate
    ) AS approved_users,

    (SELECT COUNT(*) FROM users 
        WHERE id IN (SELECT model_id FROM model_has_roles WHERE role_id = (SELECT id FROM roles WHERE name = 'user' LIMIT 1))
          AND created_at BETWEEN startDate AND endDate
    ) AS total_users,

    (SELECT COUNT(*) FROM tours 
        WHERE created_at BETWEEN startDate AND endDate
    ) AS total_tours,

    (SELECT COUNT(*) FROM bookings 
        WHERE created_at BETWEEN startDate AND endDate
    ) AS total_bookings,

    (SELECT IFNULL(SUM(total), 0.00) 
     FROM bookings 
     WHERE status = 'paid' 
       AND created_at BETWEEN startDate AND endDate
    ) AS total_paid_amount;

                -- 2nd Result Set: Paid Bookings Over Time
                IF type = 'weekly' THEN
                    SELECT 
                        days.day_label AS label,
                        IFNULL(COUNT(b.id), 0) AS count
                    FROM (
                        SELECT 'Monday' AS day_label, 2 AS day_number UNION
                        SELECT 'Tuesday', 3 UNION
                        SELECT 'Wednesday', 4 UNION
                        SELECT 'Thursday', 5 UNION
                        SELECT 'Friday', 6 UNION
                        SELECT 'Saturday', 7 UNION
                        SELECT 'Sunday', 1
                    ) AS days
                    LEFT JOIN bookings b ON DAYOFWEEK(b.created_at) = days.day_number
                        AND b.status = 'paid'
                        AND DATE(b.created_at) BETWEEN startDate AND endDate
                    GROUP BY days.day_number, days.day_label
                    ORDER BY days.day_number;

                ELSEIF type = 'monthly' THEN
                    SELECT 
                        w.week_label AS label,
                        IFNULL(COUNT(b.id), 0) AS count
                    FROM (
                        SELECT 'Week 1' AS week_label, 1 AS week_no UNION
                        SELECT 'Week 2', 2 UNION
                        SELECT 'Week 3', 3 UNION
                        SELECT 'Week 4', 4 UNION
                        SELECT 'Week 5', 5
                    ) AS w
                    LEFT JOIN bookings b ON WEEK(b.created_at, 1) - WEEK(startDate, 1) + 1 = w.week_no
                        AND b.status = 'paid'
                        AND DATE(b.created_at) BETWEEN startDate AND endDate
                    GROUP BY w.week_no, w.week_label
                    ORDER BY w.week_no;

                ELSEIF type = 'yearly' THEN
                    SELECT 
                        m.month_label AS label,
                        IFNULL(COUNT(b.id), 0) AS count
                    FROM (
                        SELECT 1 AS month_no, 'January' AS month_label UNION
                        SELECT 2, 'February' UNION
                        SELECT 3, 'March' UNION
                        SELECT 4, 'April' UNION
                        SELECT 5, 'May' UNION
                        SELECT 6, 'June' UNION
                        SELECT 7, 'July' UNION
                        SELECT 8, 'August' UNION
                        SELECT 9, 'September' UNION
                        SELECT 10, 'October' UNION
                        SELECT 11, 'November' UNION
                        SELECT 12, 'December'
                    ) AS m
                    LEFT JOIN bookings b ON MONTH(b.created_at) = m.month_no
                        AND b.status = 'paid'
                        AND DATE(b.created_at) BETWEEN startDate AND endDate
                    GROUP BY m.month_no, m.month_label
                    ORDER BY m.month_no;

                ELSE
                    SELECT 
                        DATE_FORMAT(CURDATE(), '%Y-%m-%d') AS label,
                        (SELECT COUNT(*) FROM bookings WHERE DATE(created_at) = CURDATE() AND status = 'paid') AS count;
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetDashboardStats;");
    }
};
