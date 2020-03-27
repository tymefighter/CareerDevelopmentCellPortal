const minPasswordSize = 5;
const requireUpperCase = true;
const requireSpecialChar = true;
const requireDigit = true;

function isPasswordGood(password) {
    if(password.length < minPasswordSize)
        return false;

    const regexUpper = new RegExp('[A-Z]');
    const regexSpecialChar = new RegExp('[@#$%&*]');
    const regexDigit = new RegExp('[0-9]');

    if(requireUpperCase == true)
    {
        if(regexUpper.test(password) == false)
            return false;
    }

    if(requireSpecialChar == true)
    {
        if(regexSpecialChar.test(password) == false)
            return false;
    }

    if(requireDigit == true)
    {
        if(regexDigit.test(password) == false)
            return false;
    }

    return true;
}

function checkDateFormat(date_val) {
    
    if(date_val.length != 10)
        return false;

    const regexDate = new RegExp('[12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])');
    return regexDate.test(date_val);
}

function validateRegStudent() {
    var form_element = document.forms['reg_student'];

    if(form_element['password'].value != form_element['re_password'].value) {
        alert('Both Passwords do not match');
        return false;
    }

    if(isPasswordGood(form_element['password'].value) == false) {
        var alert_message = 'Password must contain ' + minPasswordSize.toString() + ' characters\n';
        if(requireUpperCase == true)
            alert_message = alert_message + 'Password must contain atleast one uppercase character';
        if(requireSpecialChar == true)
            alert_message = alert_message + 'Password must contain atleast one character among @, #, $, %, &, *\n';
        if(requireDigit == true)
            alert_message = alert_message + 'Password must contain atleast one digit\n';
        
        alert(alert_message);
        return false;
    }

    // Anything but a digit
    const regexOtherThanDigit = new RegExp('[^0-9]');

    if(regexOtherThanDigit.test(form_element['roll_number'].value) == true) {
        alert('Roll Number contains characters other than digits');
        return false;
    }

    if(regexOtherThanDigit.test(form_element['pincode'].value) == true) {
        alert('Pincode contains characters other than digits');
        return false;
    }
    
    if(regexOtherThanDigit.test(form_element['phone_1'].value) == true) {
        alert('Phone number contains characters other than digits');
        return false;
    }

    if(regexOtherThanDigit.test(form_element['phone_2'].value) == true) {
        alert('Alternate phone number contains characters other than digits');
        return false;
    }

    if(checkDateFormat(form_element['dob'].value) == false) {
        alert('Date Format should be yyyy-mm-dd');
        return false;
    }

    return true;
}

function validateRegOfficial() {
    var form_element = document.forms['reg_offical'];

    if(form_element['password'].value != form_element['re_password'].value) {
        alert('Both Passwords do not match');
        return false;
    }

    if(isPasswordGood(form_element['password'].value) == false) {
        var alert_message = 'Password must contain ' + minPasswordSize.toString() + ' characters\n';
        if(requireUpperCase == true)
            alert_message = alert_message + 'Password must contain atleast one uppercase character';
        if(requireSpecialChar == true)
            alert_message = alert_message + 'Password must contain atleast one character among @, #, $, %, &, *\n';
        if(requireDigit == true)
            alert_message = alert_message + 'Password must contain atleast one digit\n';
        
        alert(alert_message);
        return false;
    }

    // Anything but a digit
    const regexOtherThanDigit = new RegExp('[^0-9]');
    
    if(regexOtherThanDigit.test(form_element['phone_1'].value) == true) {
        alert('Phone number contains characters other than digits');
        return false;
    }

    if(regexOtherThanDigit.test(form_element['phone_2'].value) == true) {
        alert('Alternate phone number contains characters other than digits');
        return false;
    }

    return true;
}

function validateRegVolunteer() {
    var form_element = document.forms['reg_volunteer'];

    if(form_element['password'].value != form_element['re_password'].value) {
        alert('Both Passwords do not match');
        return false;
    }

    if(isPasswordGood(form_element['password'].value) == false) {
        var alert_message = 'Password must contain ' + minPasswordSize.toString() + ' characters\n';
        if(requireUpperCase == true)
            alert_message = alert_message + 'Password must contain atleast one uppercase character';
        if(requireSpecialChar == true)
            alert_message = alert_message + 'Password must contain atleast one character among @, #, $, %, &, *\n';
        if(requireDigit == true)
            alert_message = alert_message + 'Password must contain atleast one digit\n';
        
        alert(alert_message);
        return false;
    }

    // Anything but a digit
    const regexOtherThanDigit = new RegExp('[^0-9]');

    if(regexOtherThanDigit.test(form_element['roll_number'].value) == true) {
        alert('Roll Number contains characters other than digits');
        return false;
    }

    if(checkDateFormat(form_element['doj'].value) == false) {
        alert('Date Format should be yyyy-mm-dd');
        return false;
    }

    return true;
}