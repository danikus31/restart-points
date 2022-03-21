//отправка аякс через пост

function add_point(){
    
    var var_name = document.getElementById("input_name").value;
    
    var var_surname = document.getElementById("input_surname").value;
    
    
    //var file = document.getElementById("file").files[0];
    
    var params = "name=" + var_name  + '&' + "surname=" + var_surname;
    
    ajaxGet(params);
    
    function ajaxGet(params){
        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                //обработка данных из вывода поста
                
                console.log(this.responseText);
                
                
                document.getElementById("input_name").value = null;
                
                document.getElementById("input_surname").value = null;
                
                document.getElementById("input_name").focus();
                
            }
        };
        
        request.open('POST','filtre.php');
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(params);
    }
}

  
  
  
  
  
  
  
  
  
  
  
  
  