var flagOpen = 0;
function showMessageBox(id)
{
    flagOpen = 1;
    $('#directMessage').text('');
    document.getElementById('chat-box').style.display='block';
    $.post('ajax/messageGet.php',
        {
            messageTo:id

        },
        function (data,status)
        {
            $('#directMessage').append(data)

        });
    document.getElementById('messageTo').value=id;
    document.getElementById("directMessage").scrollTop = document.getElementById("directMessage").scrollHeight;
}

function closeBox()
{
    flagOpen=0;
    document.getElementById('chat-box').style.display='none';
}

$(document).ready(function ()
{
    $("#submit1").click(function ()
    {
        var mTo = document.getElementById('messageTo').value;
        $.post('ajax/messageSend.php',
            {
                messageTo:mTo,
                message:$('#message').val()
            },function (data)
            {
                $('#directMessage').append(data);
            });
        document.getElementById('message').value='';
        document.getElementById("directMessage").scrollTop = document.getElementById("directMessage").scrollHeight+100;
    });

});

var timer, delay = 2000;
timer = setInterval(function()
{
    if(flagOpen==1)
    {
        var mTo = document.getElementById('messageTo').value;
        $.post("ajax/singleMessageGet.php",{messageTo:mTo},function (data)
        {
            $('#directMessage').append(data);
        });
    }

}, delay);
