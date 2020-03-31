-- This procedure is used to update the password of an account
-- given the account's username and previous password
delimiter #
create procedure update_password (username varchar(30), prev_pass varchar(320), new_pass varchar(320))
begin
    update login_details set password = SHA(new_pass) where login_details.username = username and login_details.password = SHA(prev_pass);
end #
delimiter ;