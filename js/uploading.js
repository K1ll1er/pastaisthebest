$(document).ready(function() {

    $.getJSON(
        "includes/backenduploading.php?f=getFileList",function(response) {

            console.log(response);

        });


    function createMyFileList(data) {

        var myhtml="";

        for (var i=0; i<data.file_list.length; i++) {

            //if (data[0]==="."||data[0]==="..") continue;




            myhtml+='<li><a href="includes/backenduploading.php?d=files/'+data.user_id+'/'+data.file_list[i]+'">'+data.file_list[i]+'</a></li>';


        }
        $('#files').html(myhtml);
    }

});