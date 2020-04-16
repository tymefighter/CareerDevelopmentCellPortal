-- Get All student info
delimiter #
create procedure get_all_student_info()
    begin
        select student.roll_number, student.name, cgpa, has_branch.name, year_of_admission
        from student, cgpa, has_branch, belongs_to
        where
            student.roll_number = has_branch.roll_number
            and student.roll_number = belongs_to.roll_number
            and student.roll_number = cgpa.roll_number;
    end #
delimiter ;

-- Get All students applied to an internship
delimiter #
create procedure get_applied_students_internship(in internship_id char(9))
    begin
        select student.roll_number, student.name, cgpa, has_branch.name, year_of_admission
        from student, cgpa, has_branch, belongs_to, apply_internship
        where 
            apply_internship.internship_id = internship_id
            and apply_internship.roll_number = student.roll_number
            and student.roll_number = has_branch.roll_number
            and student.roll_number = belongs_to.roll_number
            and student.roll_number = cgpa.roll_number;
    end #
delimiter ;

-- Get All students applied to an internship
delimiter #
create procedure get_applied_students_job(in job_id char(9))
    begin
        select student.roll_number, student.name, cgpa, has_branch.name, year_of_admission
        from student, cgpa, has_branch, belongs_to, apply_job
        where 
            apply_job.job_id = job_id
            and apply_job.roll_number = student.roll_number
            and student.roll_number = has_branch.roll_number
            and student.roll_number = belongs_to.roll_number
            and student.roll_number = cgpa.roll_number;
    end #
delimiter ;

-- Update Academic Details, and unverified student, and removes student
-- verification request
delimiter #
create procedure update_academic_details(in roll_number char(9), 
    in sem1 decimal(4,2), in sem2 decimal(4,2), in sem3 decimal(4,2), in sem4 decimal(4,2),
    in sem5 decimal(4,2), in sem6 decimal(4,2), in sem7 decimal(4,2), in sem8 decimal(4,2))
    begin
        update academic_performance set sem1 = sem1, sem2 = sem2, sem3 = sem3, sem4 = sem4,
            sem5 = sem5, sem6 = sem6, sem7 = sem7, sem8 = sem8;
        
        delete from is_verified where roll_number = roll_number;
        
        delete from verification_req where roll_number = roll_number;
    end #
delimiter ;