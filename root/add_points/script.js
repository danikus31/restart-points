function clearsearch(){
    document.getElementById("myInput").value = null;
    document.getElementById("myInput").focus();
    $('.user_block').css('display', 'grid');
    $(".clear_search").css('display', 'none');
}


function add_point(x){
    
    
    document.getElementById("personadd"+x).classList.toggle("loading");
    
    var params = 'id=' + x;
    var request = new XMLHttpRequest();
    
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            //обработка данных из вывода поста
            var lol =  JSON.parse(request.responseText);
            
            console.log(lol);
                
            document.getElementById("personid"+x).innerHTML = "очки = " + lol['points'];
            
            document.getElementById("personadd"+x).classList.toggle("used");
            
            document.getElementById("personminus"+x).classList.toggle("used");
            
            document.getElementById("personadd"+x).classList.toggle("loading");
            
            document.getElementById("online_counter").innerHTML = lol["online_counter"];
            
        }
    };
    
    request.open('POST','ajax/add_point.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
    
    
    
    
    
}

function undo_point(x){
    
    
    document.getElementById("personminus"+x).classList.toggle("loading");
    
    var params = 'id=' + x;
    var request = new XMLHttpRequest();
    
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            //обработка данных из вывода поста
            var lol =  JSON.parse(request.responseText);
            
            console.log(lol);

                
            document.getElementById("personid"+x).innerHTML = "очки = " + lol['points'];
            
            document.getElementById("personadd"+x).classList.toggle("used");
            
            document.getElementById("personminus"+x).classList.toggle("used");
            
            document.getElementById("personminus"+x).classList.toggle("loading");
            
            document.getElementById("online_counter").innerHTML = lol["online_counter"];
            
            
            
            
        }
    };
    
    request.open('POST','ajax/undo_point.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
   
}



$("#myInput").on("keyup", function() {
    if(!$("#myInput").val()){
        $(".clear_search").css('display', 'none');
    }else{
        $(".clear_search").css('display', 'block');
    }
    var value = $(this).val().toLowerCase();
    $("#users .user_block").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});


  
function showinterface(x){
    document.getElementById(x).getElementsByClassName("user_info")[0].classList.toggle("none");
}


function add_birth_day(x){
    
    var params = 'birth=' + document.getElementById("personyear"+x).value + '-' + document.getElementById("personmonth"+x).value + '-' + document.getElementById("personday"+x).value  + '&' + "id=" + x;
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            //обработка данных из вывода поста
            alert(request.responseText);
        }
    };
    
    request.open('POST','ajax/add_birth_day.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
}



var today = new Date();

var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

if(date == document.getElementById("now_is_date").innerHTML){
    
    //alert("good");
}else{
    //alert("bad");
    location.reload();
}


function controler_chose(){
    var params = "stat=" + 1; 
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var lol = JSON.parse(request.responseText);
            
            console.log(lol['count']);
            
            document.getElementById("controler_close_chose").classList.toggle("none");
            document.getElementById("controler_chose").classList.toggle("none");
            
            
            document.getElementById("controler_counter").innerHTML = lol['count'];
            
        }
    };
    request.open('POST','ajax/projector.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
}

function controler_close_chose(){
    var params = "stat=" + 2; 
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var lol = JSON.parse(request.responseText);
            
            console.log(lol['count']);
            
            document.getElementById("controler_close_chose").classList.toggle("none");
            document.getElementById("controler_chose").classList.toggle("none");
            
            document.getElementById("controler_counter").innerHTML = lol['count'];
            
            
        }
    };
    request.open('POST','ajax/projector.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
    
}

function controler_drop(){
    var params = "stat=" + 3; 
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var lol = JSON.parse(request.responseText);
            
            console.log(lol['count']);
            
            document.getElementById("controler_counter").innerHTML = lol['count'];
            
            
        }
    };
    request.open('POST','ajax/projector.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
    
}

function display_controler(){
    document.getElementById("controler").classList.toggle("hidden");
    document.getElementById("controler_wrapper_id").classList.toggle("hidden");
    
}
function controler_close(){
    document.getElementById("controler").classList.toggle("hidden");
    document.getElementById("controler_wrapper_id").classList.toggle("hidden");
}











