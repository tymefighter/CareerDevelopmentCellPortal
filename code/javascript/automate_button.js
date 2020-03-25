function clickMenuButton(x) {
    x.classList.toggle('change');

    var nav_class_ele = document.getElementsByClassName('nav');

    for(var i = 0;i < nav_class_ele.length; i++) {
        var element = nav_class_ele[i];
        if(element.tagName == 'LI') {
            if(element.style.display == 'block')
                element.style.display = 'none';
            else
                element.style.display = 'block';
        }
    }
}