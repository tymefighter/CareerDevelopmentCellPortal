-- This procedure gives details of all the internships
-- that a given company offers
delimiter #
create procedure get_all_internships(in company_id char(9))
    begin
        select internship.internship_id, name, description, stipend, duration, min_cgpa, date from internship, placed_internship
            where internship.internship_id = placed_internship.internship_id and placed_internship.company_id = company_id;
    end #
delimiter ;