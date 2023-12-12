import React,{useState,useEffect} from "react"
import {useNavigate} from "react-router-dom"
import Alert from "react-bootstrap/Alert";
import Header from "./Header"
function Login()
{
    const [email,setEmail]=useState("")
    const [password,setPassword]=useState("")
    const [error, setError] = useState("");
    const navigate= useNavigate();
    useEffect(()=>{
        if(localStorage.getItem('user-info'))
        {
            navigate('/news')
        }
    })

    async function login(){
        let item={password,email}

        let result = await fetch("http://localhost:8000/api/v1/login",{
            method:"POST",
            body:JSON.stringify(item),
            headers:{
                'Accept':'application/json',
                'Content-Type':'application/json'
            }
        })
        result = await result.json()

        
    
        console.warn(result.token)

        if (result?.token) {
            localStorage.setItem("user-info",JSON.stringify(result))
            navigate('/news'); // Navigates to '/news'
          } else {
            console.log(result.message)
            setError(result.message)
          }

        
    }

    function ErrorAlerts() {
        if (error.length === 0) {
          return null; // Don't render anything when there are no errors
        }
    }


  

    return (
        <div>
            <Header/>
            <div className="col-sm-6 offset-sm-3">
            <h1>Login page</h1>
            <input type="text" value={email} onChange={(e)=>setEmail(e.target.value)} className="form-control" placeholder="email" /><br/>
            <input type="password" value={password} onChange={(e)=>setPassword(e.target.value)} className="form-control" placeholder="password" /><br/>
            {error && <Alert variant="danger">{error}</Alert>}
            <button onClick={login} className="btn btn-primary">Login</button>
            </div>
        </div>
    )
}
export default Login