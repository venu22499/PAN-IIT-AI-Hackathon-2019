<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script>
</head>
<style type="text/css">
  html, body {
  background: #efefef;      
  height:100%;  
}
#center-text {          
  display: flex;
  flex: 1;
  flex-direction:column; 
  justify-content: center;
  align-items: center;  
  height:100%;
  
}
#chat-circle {
  position: fixed;
  bottom: 30%;
  right:47%;
  background: #f44336;
  width: 80px;
  height: 80px;  
  border-radius: 50%;
  color: white;
  padding: 28px;
  cursor: pointer;
  box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

.btn#my-btn {
     background: white;
    padding-top: 13px;
    padding-bottom: 12px;
    border-radius: 45px;
    padding-right: 40px;
    padding-left: 40px;
    color: #5865C3;
}
#chat-overlay {
    background: rgba(255,255,255,0.1);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: none;
}


.chat-box {
  display:none;
  background: #efefef;
  position:fixed;
  right:35%;
  top:10%;  
  width:550px;
  max-width: 95vw;
  max-height:100vh;
  border-radius:5px;  
/*   box-shadow: 0px 5px 35px 9px #464a92; */
  box-shadow: 0px 5px 35px 9px #ccc;
}
.chat-box-toggle {
  float:right;
  margin-right:15px;
  cursor:pointer;
}
.chat-box-header {
  background: #f44336;
  height:70px;
  border-top-left-radius:5px;
  border-top-right-radius:5px; 
  color:white;
  text-align:center;
  font-size:20px;
  padding-top:17px;
}
.chat-box-body {
  position: relative;  
  height:370px;  
  height:auto;
  border:1px solid #ccc;  
  overflow: hidden;
}
.chat-box-body:after {
  content: "";
  background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4=');
  opacity: 0.1;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  height:100%;
  position: absolute;
  z-index: -1;   
}
#chat-input {
  background: #f4f7f9;
  width:100%; 
  position:relative;
  height:47px;  
  padding-top:10px;
  padding-right:50px;
  padding-bottom:10px;
  padding-left:15px;
  border:none;
  resize:none;
  outline:none;
  border:1px solid #ccc;
  color:#888;
  border-top:none;
  border-bottom-right-radius:5px;
  border-bottom-left-radius:5px;
  overflow:hidden;  
}
.chat-input > form {
    margin-bottom: 0;
}
#chat-input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #ccc;
}
#chat-input::-moz-placeholder { /* Firefox 19+ */
  color: #ccc;
}
#chat-input:-ms-input-placeholder { /* IE 10+ */
  color: #ccc;
}
#chat-input:-moz-placeholder { /* Firefox 18- */
  color: #ccc;
}
.chat-submit {  
  position:absolute;
  bottom:3px;
  right:10px;
  background: transparent;
  box-shadow:none;
  border:none;
  border-radius:50%;
  color:#f44336;
  width:35px;
  height:35px;  
}
.chat-logs {
  padding:15px; 
  height:370px;
  overflow-y:scroll;
}

.chat-logs::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  background-color: #F5F5F5;
}

.chat-logs::-webkit-scrollbar
{
  width: 5px;  
  background-color: #F5F5F5;
}

.chat-logs::-webkit-scrollbar-thumb
{
  background-color: #5A5EB9;
}



@media only screen and (max-width: 500px) {
   .chat-logs {
        height:40vh;
    }
}

.chat-msg.user > .msg-avatar img {
  width:45px;
  height:65px;
  border-radius:50%;
  float:left;
  width:15%;
}
.chat-msg.self > .msg-avatar img {
  width:45px;
  height:65px;
  border-radius:50%;
  float:right;
  width:15%;
}
.cm-msg-text {
  background:white;
  padding:10px 15px 10px 15px;  
  color:#666;
  max-width:75%;
  float:left;
  margin-left:10px; 
  position:relative;
  margin-bottom:20px;
  border-radius:30px;
}
.chat-msg {
  clear:both;    
}
.chat-msg.self > .cm-msg-text {  
  float:right;
  margin-right:10px;
  background: #f44336;
  color:white;
}
.cm-msg-button>ul>li {
  list-style:none;
  float:left;
  width:50%;
}
.cm-msg-button {
    clear: both;
    margin-bottom: 70px;
}
</style>
<body>
<div id="center-text">
    <h2>Career BOT</h2>
  </div> 
<div id="body"> 
  
<div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
        <i class="material-icons">people</i>
  </div>
  
  <div class="chat-box">
    <div class="chat-box-header">
      Career Bot
      <span class="chat-box-toggle"><i class="material-icons">close</i></span>
    </div>
    <div class="chat-box-body">
      <div class="chat-box-overlay">   
      </div>
      <div class="chat-logs">
       
      </div><!--chat-log -->
    </div>
    <div class="chat-input">      
      <form>
        <input type="text" id="chat-input" placeholder="Send a message..."/>
      <button type="submit" class="chat-submit" id="chat-submit"><i class="material-icons">send</i></button>
      </form>      
    </div>
  </div>
  
  
  
  
</div>
</body>
</html>
<script type="text/javascript">
  $(function() {
  var INDEX = 0;
  var string='';
  var count = 0;


  $("#chat-submit").click(function(e) {
    e.preventDefault();
    var msg = $("#chat-input").val(); 
    if(msg.trim() == ''){
      return false;
    }
    generate_message(msg, 'self');
    if (count == 0){
          count = count + 1;
         ug_spec = msg;
         string = string + ' ' + ug_spec;
        var user_msg='Any  Post Graduation';
        var buttons_pg = [
        {
          name: 'Yes',
          value: 'yes'
        },
        {
          name: 'No',
          value: 'no'
        }
      ];  
         setTimeout(function() {  

          generate_button_message(user_msg,buttons_pg); 

    }, 1000)
    }
    else if (count == 5 && msg == 'programming'){
      var enter_edu ='It-Software / Software services<br> avg pay(2016)*:6,00,000<br> growth rate: 11% ';
       setTimeout(function() {  

          generate_message(enter_edu,'user');
           var user_msg='Are you willing to start again';
                                                 var buttons_d = [
                                                 {
                                                   name: 'Start again',
                                                   value: 'start'
                                                 },
                                                 {
                                                  name: 'exit',
                                                   value: 'exit'
                                                 }
                                                ];  
                                                 generate_button_message(user_msg,buttons_d);
    }, 1000)
    }
    // else if (count == 5 && msg == 'sales'){
    //   var enter_edu ='It-Software / Software services<br> avg pay(2016)*:6,00,000<br> growth rate: 11% ';
    //    setTimeout(function() {  

    //       generate_message(enter_edu,'user'); 

    // }, 1000)
    // }
    // else if (count == 5 && msg == 'Accounts'){
    //   var enter_edu ='It-Software / Software services<br> avg pay(2016)*:6,00,000<br> growth rate: 11% ';
    //    setTimeout(function() {  

    //       generate_message(enter_edu,'user'); 

    // }, 1000)
    // }
    // else if (count == 5 && msg == 'Marketing'){
    //   var enter_edu ='It-Software / Software services<br> avg pay(2016)*:6,00,000<br> growth rate: 11% ';
    //    setTimeout(function() {  

    //       generate_message(enter_edu,'user'); 

    // }, 1000)
    // }
    else if (count == 1){
       count = count + 1;
      pg_spec = msg;
      string = string + ' ' + pg_spec;
      var user_msg='Any  Doctorate';
        var buttons_d = [
        {
          name: 'Yes',
          value: 'yes_doc'
        },
        {
          name: 'No',
          value: 'no_doc'
        }
      ];  
         setTimeout(function() {  

          generate_button_message(user_msg,buttons_d); 

    }, 1000)
      
    }

  else if (count ==  2){
    count = count + 1;
    doc_spec = msg;
      string = string + ' ' + doc_spec;
      var user_msg='will get you in a minute';
         setTimeout(function() {  

          generate_message(user_msg,'user');
          console.log(string); 
          var str = string;
    var replaced = str.split(' ').join('+');
    $.ajax({
                                              type:'post',
                                              url:'<?php echo base_url() ;?>index.php/home/output',
                                              data:{info:replaced},
                                              success:function(response){
                                                  //console.log(response);
                                                  var result = response + '<br>avg pay: 6,74,562<br> growth rate(2016)*:7%';
                                                  generate_message(result,'user');
                                                    count=0;
                                                    var user_msg='Are you willing to start again';
                                                 var buttons_d = [
                                                 {
                                                   name: 'Start again',
                                                   value: 'start'
                                                 },
                                                 {
                                                  name: 'exit',
                                                   value: 'exit'
                                                 }
                                                ];  
                                                   setTimeout(function() {  
                                          
                                                    generate_button_message(user_msg,buttons_d); 

                                             }, 1000)                                         
                                                 
                                                 }

                                            });

    }, 1000)
      

  }

    
    
  })
  
  function generate_message(msg, type) {
    INDEX++;
    var str="";
    str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg "+type+"\">";
    // str += "          <span class=\"msg-avatar\">";
    // str += "            <img src=\"https:\/\/image.crisp.im\/avatar\/operator\/196af8cc-f6ad-4ef7-afd1-c45d5231387c\/240\/?1483361727745\">";
    // str += "          <\/span>";
    str += "          <div class=\"cm-msg-text\">";
    str += msg;
    str += "          <\/div>";
    str += "        <\/div>";
    $(".chat-logs").append(str);
    $("#cm-msg-"+INDEX).hide().fadeIn(300);
    if(type == 'self'){
     $("#chat-input").val(''); 
    }    
    $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);    
  }  
  
  function generate_button_message(msg, buttons){    
    /* Buttons should be object array 
      [
        {
          name: 'Existing User',
          value: 'existing'
        },
        {
          name: 'New User',
          value: 'new'
        }
      ]
    */
    INDEX++;
    var btn_obj = buttons.map(function(button) {
       return  "              <li class=\"button\"><a href=\"javascript:;\" class=\"btn btn-primary chat-btn\" chat-value=\""+button.value+"\">"+button.name+"<\/a><\/li>";
    }).join('');
    var str="";
    str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg user\">";
    str += "          <span class=\"msg-avatar\">";
    str += "            <img src=\"https:\/\/image.crisp.im\/avatar\/operator\/196af8cc-f6ad-4ef7-afd1-c45d5231387c\/240\/?1483361727745\">";
    str += "          <\/span>";
    str += "          <div class=\"cm-msg-text\">";
    str += msg;
    str += "          <\/div>";
    str += "          <div class=\"cm-msg-button\">";
    str += "            <ul>";   
    str += btn_obj;
    str += "            <\/ul>";
    str += "          <\/div>";
    str += "        <\/div>";
    $(".chat-logs").append(str);
    $("#cm-msg-"+INDEX).hide().fadeIn(300);   
    $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);
    $("#chat-input").attr("disabled", true);
  }
  
  $(document).delegate(".chat-btn", "click", function() {
    var value = $(this).attr("chat-value");
    var name = $(this).html();
    $("#chat-input").attr("disabled", false);
    var enter_gender='Select your gender';
    if( value == 'start'){
       setTimeout(function() {
        string = '';
        var enter_edu ='Mention your Education Profile';
        var ug='base of suggestion';
        var buttons_gender = [
        {
          name: 'Education',
          value: 'edu'
        },
        {
          name: 'Skills',
          value: 'skill'
        }
      ];  
        generate_button_message(ug, buttons_gender);
         
    }, 1000)
    }
    if( value == 'skill'){
      count = count+5;
       setTimeout(function() {
        var enter_edu ='Mention your Top Skill in broad aspect';
        generate_message(enter_edu,'user');
         
    }, 1000)
    }
    else if( value == 'edu'){
       setTimeout(function() {
        var enter_edu ='Mention your Education Profile';
        var ug='Your Under Graduation'
        var buttons_gender = [
        {
          name: 'Yes',
          value: 'yes_ug'
        },
        {
          name: 'No',
          value: 'no_ug'
        }
      ];  
        generate_button_message(ug, buttons_gender);
         
    }, 1000)
    }
    else if( value =='no_ug'){
        var near ='Nearest career guidance centers';
        var near1 ='Education Guidance,<br>contact:95406 15555';
        var near2 ='Adnission career guidance <br>contact:011 2616 3235';
        generate_message(near,'user');
        generate_message(near1,'user');
        generate_message(near2,'user');
        var user_msg='Are you willing to start again';
        var buttons_d = [
                                                 {
                                                   name: 'Start again',
                                                   value: 'start'
                                                 },
                                                 {
                                                  name: 'exit',
                                                   value: 'exit'
                                                 }
                                                ];  
                   setTimeout(function() {  
                                          
                                                    generate_button_message(user_msg,buttons_d); 

                                             }, 1000)
    }
    else if(value =='yes_ug'){
      string = string + ' undergraduate';
     setTimeout(function() {
        var enter_edu ='Mention your Education Profile';
        var ug='Your Under Graduation'
        var buttons_gender = [
        {
          name: 'B.Tech/B.E',
          value: 'b.tech'
        },
        {
          name: 'B.com',
          value: 'b.com'
        },
        {
          name:'Diploma',
          value:'diploma'
        },
        {
          name:'B.Arch',
          value:'b.arch'
        },
        {
          name:'Others',
          value:'any graduation'
        }
      ];  
        generate_button_message(enter_edu, buttons_gender);
         
    }, 1000)
      
   }
   else if (value =='b.tech'){
    setTimeout(function() {
        string = string + ' b.tech b.e';
        var enter_spec ='Enter your specialization in UG';
        var example ='Example : Electrical Telecommunication';
        generate_message(enter_spec,'user');
        //generate_message(example,'user'); 
    }, 1000)
   }
    else if (value =='b.arch'){
    setTimeout(function() {
        string = string + ' b.arch';
        var enter_spec ='Enter your specialization in UG';
        var example ='Example : Architechture';
        generate_message(enter_spec,'user');
        //generate_message(example,'user'); 
    }, 1000)
   }

   else if (value=='b.com'){
    setTimeout(function() {
        string = string + ' b.com';
        var enter_spec ='Enter your specialization in UG';
        var example ='Example : Computers';
    
        generate_message(enter_spec,'user');
       // generate_message(example,'user'); 
    }, 1000)
   }
   else if (value=='diploma'){
    setTimeout(function() {
        string = string + ' diploma';
        var enter_spec ='Enter your specialization in UG';
        var example ='Example : Computers';
        generate_message(enter_spec,'user');
       // generate_message(example,'user'); 
    }, 1000)
   }   
  else if (value=='any graduation'){
    setTimeout(function() {
        string = string + ' others';
        var enter_spec ='Enter your specialization in UG';
         var example ='Example : BHM Hotel Management';
    
        generate_message(enter_spec,'user');
        //generate_message(example,'user');
         
    }, 1000)
   }
   else if ( value =='yes' ){
    string = string +' ' + 'postgraduate';
    setTimeout(function() {
        var enter_edu ='Mention your Education Profile in PG';
      
        var buttons_gender = [
        {
          name: 'M.tech',
          value: 'm.tech'
        },
        {
          name: 'MBA',
          value: 'mba'
        },
        {
          name:'MSC/ MS',
          value:'msc ms'
        },
        {
          name:'MA',
          value:'ma'
        },
        {
          name:'MCOM',
          value:'m.com'
        },
        {
          name:'MCA',
          value:'mca'
        },
        {
          name:'Others',
          value:'others'
        }
      ];  
        generate_button_message(enter_edu, buttons_gender);
         
    }, 1000)
   }
   else if  (value =='m.tech' || value =='mba' || value == 'm.com' || value =='mca' || value =='others' || value =='ma' || value =='msc ms'){
        setTimeout(function() {
        string = string + ' ' + value;
        var enter_spec ='Enter your specialization in PG';
         var example ='Example : MBA finance';
        generate_message(enter_spec,'user');
        //generate_message(example,'user');
         
    }, 1000)
   }
  
  else if (value == 'no'){
    var final ='will get you in a minute';
    generate_message(final,'user');
    console.log(string);
    var str = string;
    var replaced = str.split(' ').join('+');
    $.ajax({
                                              type:'post',
                                              url:'<?php echo base_url() ;?>index.php/home/output',
                                              data:{info:replaced},
                                              success:function(response){
                                                  //console.log(response);
                                                  var result = response+'<br>avg pay: 7,76,897<br> growth rate(2016)*: 11%';
                                                  generate_message(result,'user');
                                                    count=0;
                                                    var user_msg='Are you willing to start again';
                                                 var buttons_d = [
                                                 {
                                                   name: 'Start again',
                                                   value: 'start'
                                                 },
                                                 {
                                                  name: 'exit',
                                                   value: 'exit'
                                                 }
                                                ];  
                                                   setTimeout(function() {  
                                          
                                                    generate_button_message(user_msg,buttons_d); 

                                             }, 1000)
                                                 
                                                 }

                                            });

  } 

  else if  (  value =='yes_doc'){
    string =  string +' ' + 'doctorate';
    setTimeout(function() {
        var enter_spec ='Enter your specialization in Doctorate';
    
        generate_message(enter_spec,'user');
         
    }, 1000)
  } 
  else if( value =='no_doc'){
    var final ='will get you in a minute';
    generate_message(final,'user');
    console.log(string);
    var str = string;
    var replaced = str.split(' ').join('+');
    $.ajax({
                                              type:'post',
                                              url:'<?php echo base_url() ;?>index.php/home/output',
                                              data:{info:replaced},
                                              success:function(response){
                                                  //console.log(response);
                                                  var result = response +'<br>avg pay:6,19,326<br>growth rate: 6%';
                                                  generate_message(result,'user');
                                                    count=0;
                                                    var user_msg='Are you willing to start again';
                                                 var buttons_d = [
                                                 {
                                                   name: 'Start again',
                                                   value: 'start'
                                                 },
                                                 {
                                                  name: 'exit',
                                                   value: 'exit'
                                                 }
                                                ];  
                                                   setTimeout(function() {  
                                          
                                                    generate_button_message(user_msg,buttons_d); 

                                             }, 1000)
                                                 
                                                 }

                                            });

  } 
  else if( value =='exit'){
     $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
    location.reload();
  }  
         
  })
  
  $("#chat-circle").click(function() {    
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
    var welcome ='Hi! We are here for you to suggest the best career for your life.'
     // generate_message(msg, 'self');
     
      var buttons_lang = [
        {
          name: 'Start Chating',
          value: 'start'
        },
        {
          name: 'Exit',
          value: 'exit'
        }
      ];
       generate_button_message(welcome, buttons_lang); 
  })
  
  $(".chat-box-toggle").click(function() {
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })
  
})
</script>
