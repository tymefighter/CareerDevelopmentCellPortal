-- Accept student for internship
-- 1) Remove all applications of student
-- 2) Give student internship
delimiter #
create procedure accept_student_internship(in roll_number char(9), in internship_id char(9))
    begin
        delete from apply_internship where apply_internship.roll_number = roll_number;
        delete from apply_job where apply_job.roll_number = roll_number;
        insert into accept_internship values (roll_number, internship_id);
    end #
delimiter ;

delimiter #
create procedure accept_student_job(in roll_number char(9), in job_id char(9))
    begin
        delete from apply_internship where apply_internship.roll_number = roll_number;
        delete from apply_job where apply_job.roll_number = roll_number;
        insert into accept_job values (roll_number, job_id);
    end #
delimiter ;