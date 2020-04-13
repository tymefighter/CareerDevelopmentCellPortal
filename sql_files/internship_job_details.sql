-- This procedure gives details of all the internships
-- that a given company offers
delimiter #
create procedure get_all_internships(in company_id char(9))
    begin
        select internship.internship_id, name, description, stipend, duration, min_cgpa, date from internship, placed_internship
            where internship.internship_id = placed_internship.internship_id and placed_internship.company_id = company_id;
    end #
delimiter ;

-- This procedure gives details of all the jobs
-- that a given company offers
delimiter #
create procedure get_all_jobs(in company_id char(9))
    begin
        select job.job_id, name, description, CTC, perks, min_cgpa, date from job, placed_job
            where job.job_id = placed_job.job_id and placed_job.company_id = company_id;
    end #
delimiter ;

-- This procedure gives all internships
-- that are available to a student
delimiter #
create procedure get_allowed_internships(in roll_number char(9))
    begin
        select internship.internship_id, internship.name, company.name, internship.description,
            internship.stipend, internship.duration, internship.min_cgpa, placed_internship.date
        from company, belongs_to, cgpa, has_branch, internship, 
            placed_internship, required_batch_internship, required_branch_internship
        where
            required_batch_internship.internship_id = internship.internship_id and
            required_branch_internship.internship_id = internship.internship_id and
            belongs_to.roll_number = roll_number and
            has_branch.roll_number = roll_number and
            belongs_to.year_of_admission = required_batch_internship.year_of_admission and
            has_branch.name = required_branch_internship.branch_name and
            internship.internship_id = placed_internship.internship_id and
            placed_internship.company_id = company.company_id and
            cgpa.roll_number = roll_number and
            cgpa.cgpa >= internship.min_cgpa;
    end #
delimiter ;

-- This procedure gives all jobs
-- that are available to a student
delimiter #
create procedure get_allowed_jobs(in roll_number char(9))
    begin
        select job.job_id, job.name, company.name, job.description,
            job.CTC, job.perks, job.min_cgpa, placed_job.date
        from company, belongs_to, cgpa, has_branch, job, 
            placed_job, required_branch_job
        where
            required_branch_job.job_id = job.job_id and
            belongs_to.roll_number = roll_number and
            has_branch.roll_number = roll_number and
            belongs_to.year_of_admission = (YEAR(CURDATE()) - 4) and
            has_branch.name = required_branch_job.branch_name and
            job.job_id = placed_job.job_id and
            placed_job.company_id = company.company_id and
            cgpa.roll_number = roll_number and
            cgpa.cgpa >= job.min_cgpa;
    end #
delimiter ;

-- This procedure gives all details
-- about an internship
delimiter #
create procedure get_internship_details(in internship_id char(9))
    begin
        select 
            internship.internship_id, internship.name, company.name,
            internship.description, internship.stipend, internship.duration, 
            internship.min_cgpa, placed_internship.date
        from
            internship, placed_internship, company
        where
            internship.internship_id = internship_id and
            placed_internship.internship_id = internship_id and
            company.company_id = placed_internship.company_id;
    end #
delimiter ;

-- This procedure gives all details
-- about a job