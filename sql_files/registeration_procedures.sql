delimiter #
create procedure register_student (
    in username varchar(30),
    in password varchar(320),
    in roll_number char(9),
    in name varchar(30),
    in nationality varchar(320),
    in dob date,
    in gender enum('M','F','O'),
    in tenth_percentage decimal(4,2),
    in tenth_board varchar(30),
    in twelfth_percentage decimal(4,2),
    in twelfth_board varchar(30),
    in JEE_main_rank int(11),
    in JEE_advanced_rank int(11),
    in bldg_name varchar(320),
    in street_name varchar(320),
    in city varchar(320),
    in state varchar(320),
    in country varchar(320),
    in pincode varchar(320),
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
            bldg_name, street_name, city, state, country, pincode,
            phone_1, phone_2
        );
        insert into student_login values (roll_number, username);
    end #
delimiter ;

delimiter #
create procedure register_cdc_offical (
    in username varchar(30),
    in password varchar(320),
    in offical_id char(9),
    in name varchar(30),
    in designation varchar(30),
    in email varchar(320),
    in phone_1 varchar(30),
    in phone_2 varchar(30),
    in bldg_name varchar(320),
    in room_number varchar(30)
)
    begin
        declare encrypt_password varchar(320);
        set encrypt_password = SHA(password);

        insert into login_details values (username, encrypt_password, 'cdc_official');
        insert into cdc_official values (
            offical_id, name, designation, email, phone_1, phone_2, bldg_name, room_number
        );
        insert into official_login values (offical_id, username);
    end #
delimiter ;