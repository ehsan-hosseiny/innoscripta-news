import React,{useState,useEffect} from "react"
import {useNavigate} from "react-router-dom"
import Header from "./Header"
function Register()
{
    useEffect(()=>{
        if(localStorage.getItem('user-info'))
        {
            navigate('/news')
        }
    })
    
    const [email,setEmail]=useState("")
    const [password,setPassword]=useState("")
    const navigate= useNavigate();
    
    async function signUp(){
        console.warn(password,email)
        let item={password,email}

        let result = await fetch("http://localhost:8000/api/v1/register",{
            method:"POST",
            body:JSON.stringify(item),
            headers:{
                'Accept':'application/json',
                'Content-Type':'application/json'
            }
        })
        result = await result.json()
        localStorage.setItem("user-info",JSON.stringify(result))
        navigate('/news'); // Navigates to '/news'
        
    }
    
    
    return (
        <div>
        <Header/>
        <div className="col-sm-6 offset-sm-3">
            <h1>Register page</h1>
            <input type="text" value={email} onChange={(e)=>setEmail(e.target.value)} className="form-control" placeholder="email" /><br/>
            <input type="password" value={password} onChange={(e)=>setPassword(e.target.value)} className="form-control" placeholder="password" /><br/>
            <button onClick={signUp} className="btn btn-primary">Register</button>
            
        </div>
        </div>
    )
}
export default Register