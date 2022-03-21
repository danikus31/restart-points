var reload = 0;
var interval = 1000;
var current = null;
var previous = null;
var today_count = document.getElementById("today_counter").innerHTML;


setInterval(function() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var lol = JSON.parse(request.responseText);
            
            var count = lol['count'];
            
            var stat = lol['stat'];
            
            console.log(today_count);
            if(reload == 0){
                if(today_count != count){
                    location.reload();
                    reload = 1;
                }
            }
            
            if(stat == 1){
                myFunction();
            }else if(stat == 2){
                my_delete();
            }else if(stat == 3){
                document.getElementById("randome_btn_drop").click();
            }
            
            console.log(stat);
        }
    };
    request.open('POST','ajax/count_verify.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
    
},interval);



function myFunction(){
    document.getElementById("imaginar_person").classList.toggle("hidded");
    document.getElementById("imaginar_block").classList.toggle("hidded");
    DisplayPerson();

    function DisplayPerson(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            var lol =  JSON.parse(request.responseText);
            console.log(lol);
                        
            document.getElementById("imag_user_name").innerHTML = lol['name'];
            document.getElementById("imag_uesr_points").innerHTML = lol['points'];
            document.getElementById("imag_img").style.backgroundImage = 'url('+ lol['img']+')';
            
            setTimeout(function() {
                document.getElementById("loading").classList.toggle("loading_hiden");
            }, 1700);
            
            document.getElementById("randome_counter").innerHTML = lol['now_in_randome'];
        }
    };
    
    request.open('POST','ajax/filtre.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}
}

function my_delete(){
    document.getElementById("imaginar_person").classList.toggle("hidded");
    document.getElementById("imaginar_block").classList.toggle("hidded");
    document.getElementById("loading").classList.toggle("loading_hiden");
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            
        }
    };
    request.open('POST','ajax/delete.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}




function drop(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var lol =  JSON.parse(request.responseText);
            console.log(lol);
            
            document.getElementById("randome_counter").innerHTML = request.responseText;
        }
    };
    request.open('POST','ajax/default.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function final_prize(){
    document.getElementById("imagin_start").classList.toggle("hidded");

}



function startrandome(){
    document.getElementById("imaginar_person").classList.toggle("hidded");
    document.getElementById("imaginar_block").classList.toggle("hidded");
    
    
    document.getElementById("imagin_start").classList.toggle("hidded");
    
    setTimeout(function() {
        document.getElementById("loading").classList.toggle("loading_hiden");
    }, 8000);
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var lol =  JSON.parse(request.responseText);
            console.log(lol);
            
            document.getElementById("imag_uesr_points").innerHTML = lol['points'];
            document.getElementById("imag_user_name").innerHTML = lol['name'];
            document.getElementById("imag_img").style.backgroundImage = lol['img'];
        }
    };
    
    request.open('POST','ajax/randome_prize.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}



function team_separate(){
    document.getElementById("user_randome_selector_wrapper").classList.toggle("hidded");
}

function delete_randome_selector(){
    document.getElementById("user_randome_selector_wrapper").classList.toggle("hidded");
}



function randome_teams_ajax(x){
    
    var params = "numb=" + x; 
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            //обработка данных из вывода поста
            var teams = request.responseText;
            
            
            teams = JSON.parse(teams);
            console.log(teams);
            
            document.getElementById("user_randome_selector_wrapper").classList.toggle("hidded");
            
            document.getElementById("user_randome_finish_selector_wrapper").classList.toggle("hidded");
            var container = document.createElement("div");
            container.id = "user_randome_finish_selector_block";
            document.getElementById("user_randome_finish_selector_wrapper").appendChild(container);
            
            for(i = 0;teams[i]; i++){
                var wrapper = document.createElement("div");
                wrapper.className = "randome_team";
                
                for(a = 0;teams[i][a]; a++){
                    var box = document.createElement("div");
                    wrapper.className = "randome_team_user";
                    
                    var img = document.createElement("img");
                    img.src = teams[i][a]['img'];
                    box.appendChild(img);
                    
                    var name = document.createElement("div");
                    name.innerText = teams[i][a]['user_name'];
                    box.appendChild(name);
                    wrapper.appendChild(box);
                }
                document.getElementById("user_randome_finish_selector_block").appendChild(wrapper);
            }
        }
    };
    request.open('POST','ajax/randome_teams_shuffle.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(params);
}


function delete_randome_finish_selector(){
    document.getElementById("user_randome_finish_selector_wrapper").classList.toggle("hidded");
    
    document.querySelector("#user_randome_finish_selector_block").remove();
}



