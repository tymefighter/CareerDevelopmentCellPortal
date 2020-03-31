-- This procedure gives the average cgpa of all those students
-- that have applied to a particular job
delimiter #
create function get_avg_cgpa_job_applied (job_id char(9))
returns decimal(15, 6)
begin
    declare avg_cgpa decimal(15, 6);
    select avg(cgpa) into avg_cgpa from cgpa, apply_job where apply_job.roll_number = cgpa.roll_number and apply_job.job_id = job_id;
    return avg_cgpa;
end #

delimiter ;

-- This procedure gives the average cgpa of all those students
-- that have applied to a particular internship
delimiter #
create function get_avg_cgpa_internship_applied (internship_id char(9))
returns decimal(15, 6)
begin
    declare avg_cgpa decimal(15, 6);
    select avg(cgpa) into avg_cgpa from cgpa, apply_internship where apply_internship.roll_number = cgpa.roll_number and apply_internship.internship_id = internship_id;
    return avg_cgpa;
end #

delimiter ;

-- This procedure gives the number of students of each
-- branch that have applied for this job
delimiter #
create procedure get_branch_count_job(job_id char(9))
begin
    select has_branch.name, count(*) as branch_count from apply_job, has_branch where apply_job.roll_number = has_branch.roll_number and apply_job.job_id = job_id
        group by has_branch.name;
end #
delimiter ;

-- This procedure gives the number of students of each
-- branch that have applied for this internships
delimiter #
create procedure get_branch_count_internship(internship_id char(9))
begin
    select has_branch.name, count(*) as branch_count from apply_internship, has_branch where apply_internship.roll_number = has_branch.roll_number and apply_internship.internship_id = internship_id
        group by has_branch.name;
end #
delimiter ;

-- This procedure gives the number of students of each
-- batch that have applied for this internships
delimiter #
create procedure get_batch_count_internship(internship_id char(9))
begin
    select belongs_to.year_of_admission, count(*) as batch_count from apply_internship, belongs_to where apply_internship.roll_number = belongs_to.roll_number and apply_internship.internship_id = internship_id
        group by belongs_to.year_of_admission;
end #
delimiter ;