-- This procedure gives the information
-- about all volunteers
delimiter #
create procedure get_all_volunteer_info()
    begin
        select vol_id, roll_number, name, branch, year_of_admission,
            designation, date_join
        from
            student_vol_info;
    end #
delimiter ;