let form=document.querySelector('#form')
let itslogin=document.querySelector('#itslogin')
let itssignup=document.querySelector('#itssignup')
let loginform=document.querySelector('.login')
let signupform=document.querySelector('.singup')
let logedin=true

itslogin.style.backgroundColor ='#b652d7'
itssignup.style.backgroundColor ='rgba(255, 255, 255, 0.419)'
itssignup.style.color='rgb(74, 74, 74)'
itslogin.style.color='white'

signupform.style.display='none'

itslogin.addEventListener('click',(e)=>{
    e.preventDefault()
    logedin=true
    itslogin.style.color='white'
    itslogin.style.backgroundColor ='#b652d7'
    itssignup.style.backgroundColor ='rgba(255, 255, 255, 0.419)'
    itssignup.style.color='rgb(74, 74, 74)'
    signupform.style.display ='none'
    loginform.style.display ='flex'
    document.querySelector('#loginBtn').innerHTML="login"
})

itssignup.addEventListener('click',(e)=>{
    e.preventDefault()
    logedin=false
    itssignup.style.color='white'
    itssignup.style.backgroundColor ='#b652d7'
    itslogin.style.backgroundColor ='rgba(255, 255, 255, 0.419)'
    itslogin.style.color='rgb(74, 74, 74)'
    signupform.style.display ='flex'
    loginform.style.display ='none'
    document.querySelector('#loginBtn').innerHTML="sign up"

})



form.addEventListener('submit',(event)=>{
    // event.preventDefault()
    let username=event.target.elements.username
    let password=event.target.elements.password

    let fname=event.target.elements.fname
    let lname=event.target.elements.lname
    let email=event.target.elements.email
    let pass=event.target.elements.pass
    let Cpass=event.target.elements.Cpass
    if(logedin===true){
        if(event.target.elements.username.value=='' && event.target.elements.password.value=='' ){
        password.style.border='solid'
        password.style.borderColor='red'
        username.style.border='solid'
        username.style.borderColor='red'
        }else if(event.target.elements.username.value==''&& event.target.elements.password.value!=='' ){
            password.style.border='none'
            password.style.borderColor='red'
            username.style.border='solid'
            username.style.borderColor='red'
        }else if(event.target.elements.username.value!==''&& event.target.elements.password.value=='' ){
            password.style.border='solid'
            password.style.borderColor='red'
            username.style.border='none'
            username.style.borderColor='red'
        }

    
    }
})
