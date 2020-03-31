-- The following procedure adds an internship for a company
delimiter #
create procedure add_internship(
    in internship_id char(9),
    in company_id char(9),
    in date date,
    in name varchar(30),
    in description varchar(200),
    in stipend double,
    in duration int(11),
    in min_cgpa decimal(4,2)
)
    begin
        insert into internship values (internship_id, name, description, stipend, duration, min_cgpa);
        insert into placed_internship values (internship_id, company_id, date);
    end #
delimiter ;

-- The following procedure adds an job for a company
delimiter #
create procedure add_job(
    in job_id char(9),
    in company_id char(9),
    in date date,
    in name varchar(30),
    in description varchar(200),
    in CTC double,
    in perks varchar(200),
    in min_cgpa decimal(4,2)
)
    begin
        insert into job values (job_id, name, description, CTC, perks, min_cgpa);
        insert into placed_job values (job_id, company_id, date);
    end #
delimiter ;