const userNameValidate = () => {
  const username = $('#username').val()
  if (username.length <= 4) {
    console.log('minimum length faild')
    $('#usernamest').text('minimum length faild')
    $('#usernamest').addClass('text-danger')
    $('#usernamest').addClass('mt-1')
    $('#usernamest').removeClass('text-success')
    return false
  } else {
    $('#usernamest').text('Looks good')
    $('#usernamest').removeClass('text-danger')
    $('#usernamest').addClass('text-success')
  }
}

const passwordVal = () => {
  if ($('#indexpassword').val() == '') {
    $('#passwordst').text("Password couldn't empty!")
    $('#passwordst').addClass('mt-1')
    $('#passwordst').addClass('text-danger')
    return false
  }
}

$('#username').on('input', userNameValidate)

$('#indexbutton').on('click', (e) => {
  if (userNameValidate() == false || passwordVal() == false) {
    e.preventDefault()
    userNameValidate()
  } else {
    console.log('form submited!')
  }
})

$('#showpass').change(function () {
  if ($('#indexpassword').attr('type') == 'text') {
    $('#indexpassword').attr('type', 'password')
  } else {
    $('#indexpassword').attr('type', 'text')
  }
})
