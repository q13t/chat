$.post('nickname_validation.php', {
     nickname:$_POST['regnick'] }, 
  function(data, textStatus) {
     if (textStatus == 'success') {
       $('#span').html(data);
  }
});