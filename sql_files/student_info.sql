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
create procedure get_applied_students(in internship_id char(9))
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