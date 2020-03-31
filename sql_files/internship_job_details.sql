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
-- delimiter #
-- create procedure get_allowed_internships(in student_id char(9))
--     begin
        
--     end #
-- delimiter ;