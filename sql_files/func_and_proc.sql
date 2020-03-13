delimiter #
create procedure show_verified_batch(in batch varchar(30))
    begin
        select belongs_to.roll_number from belongs_to, is_verified where belongs_to.roll_number = is_verified.roll_number and belongs_to.year_of_admission = batch;
    end #
delimiter ;

delimiter #
create procedure show_verified_branch(in branch varchar(30))
    begin
        select has_branch.roll_number from has_branch, is_verified where has_branch.roll_number = is_verified.roll_number and has_branch.name = branch;
    end #
delimiter ;

delimiter #
create procedure verify_student(in roll_number char(9))
begin
    if (roll_number not in (select is_verified.roll_number from is_verified)) then
        insert into is_verified values (roll_number);
    end if;
end #
delimiter ;

delimiter #
create function get_avg_cgpa_job_applied (job_id char(9))
returns decimal(15, 6)
begin
    declare avg_cgpa decimal(15, 6);
    select avg(cgpa) into avg_cgpa from cgpa, apply_job where apply_job.roll_number = cgpa.roll_number and apply_job.job_id = job_id;
    return avg_cgpa;
end #

delimiter ;

delimiter #
create function get_avg_cgpa_internship_applied (internship_id char(9))
returns decimal(15, 6)
begin
    declare avg_cgpa decimal(15, 6);
    select avg(cgpa) into avg_cgpa from cgpa, apply_internship where apply_internship.roll_number = cgpa.roll_number and apply_internship.internship_id = internship_id;
    return avg_cgpa;
end #

delimiter ;

delimiter #
create procedure update_password (username varchar(30), prev_pass varchar(320), new_pass varchar(320))
begin
    update login_details set password = SHA(new_pass) where login_details.username = username and login_details.password = SHA(prev_pass);
end #
delimiter ;

delimiter #
create procedure get_branch_count_job(job_id char(9))
begin
    select has_branch.name, count(*) as branch_count from apply_job, has_branch where apply_job.roll_number = has_branch.roll_number and apply_job.job_id = job_id
        group by has_branch.name;
end #
delimiter ;

delimiter #
create procedure get_branch_count_internship(internship_id char(9))
begin
    select has_branch.name, count(*) as branch_count from apply_internship, has_branch where apply_internship.roll_number = has_branch.roll_number and apply_internship.internship_id = internship_id
        group by has_branch.name;
end #
delimiter ;

delimiter #
create procedure get_batch_count_internship(internship_id char(9))
begin
    select belongs_to.year_of_admission, count(*) as batch_count from apply_internship, belongs_to where apply_internship.roll_number = belongs_to.roll_number and apply_internship.internship_id = internship_id
        group by belongs_to.year_of_admission;
end #
delimiter ;