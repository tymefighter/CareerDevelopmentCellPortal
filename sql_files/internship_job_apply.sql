-- This procedure applies a student
-- for an internship
delimiter #
create procedure apply_internship(
    in roll_number char(9),
    in internship_id char(9),
    in date date
)
    begin
        insert into apply_internship values (roll_number, internship_id, date);
    end #
delimiter ;

-- This procedure applies a student
-- for a job
delimiter #
create procedure apply_job(
    in roll_number char(9),
    in job_id char(9),
    in date date
)
    begin
        insert into apply_job values (roll_number, job_id, date);
    end #
delimiter ;