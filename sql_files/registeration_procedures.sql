delimiter #
create procedure register_student (
    in username varchar(30),
    in password varchar(320),
    in roll_number char(9),
    in name varchar(30),
    in nationality varchar(30),
    in dob date,
    in gender enum('M','F','O'),
    in tenth_percentage decimal(4,2),
    in tenth_board varchar(30),
    in twelfth_percentage decimal(4,2),
    in twelfth_board varchar(30),
    in JEE_main_rank int(11),
    in JEE_advanced_rank int(11),
    in bldg_name varchar(30),
    in street_name varchar(30),
    in district varchar(30),
    in state varchar(30),
    in country varchar(30),
    in pincode varchar(30),
    in phone_1 varchar(30),
    in phone_2 varchar(30)
)
    begin
        declare encrypt_password varchar(320);
        set encrypt_password = SHA(password);

        insert into login_details values (username, encrypt_password, 'student');
        insert into student values (
            roll_number, name, nationality, dob, gender, tenth_percentage,
            tenth_board, twelfth_percentage, twelfth_board, 
            JEE_main_rank, JEE_advanced_rank,
            bldg_name, street_name, district, state, country, pincode,
            phone_1, phone_2
        );
        insert into student_login values (roll_number, username);
    end #
delimiter ;