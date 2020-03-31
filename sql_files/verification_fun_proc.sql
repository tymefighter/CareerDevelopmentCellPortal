-- This procedure shows all the students in a batch
-- that are verified
delimiter #
create procedure show_verified_batch(in batch varchar(30))
    begin
        select belongs_to.roll_number from belongs_to, is_verified where belongs_to.roll_number = is_verified.roll_number and belongs_to.year_of_admission = batch;
    end #
delimiter ;

-- This procedure shows all the students in a branch
-- that are verified
delimiter #
create procedure show_verified_branch(in branch varchar(30))
    begin
        select has_branch.roll_number from has_branch, is_verified where has_branch.roll_number = is_verified.roll_number and has_branch.name = branch;
    end #
delimiter ;

-- This procedure verifies an unverified student
delimiter #
create procedure verify_student(in roll_number char(9))
begin
    if (roll_number not in (select is_verified.roll_number from is_verified)) then
        insert into is_verified values (roll_number);
    end if;
end #
delimiter ;