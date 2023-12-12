import React,{useState,useEffect} from "react"
import {useNavigate} from "react-router-dom"
import Header from "./Header"
function Protected(props) {
    let Cmp = props.cmp; // Use lowercase 'cmp' prop
    const navigate= useNavigate();
    useEffect(()=>{
        if(!localStorage.getItem('user-info'))
        {
            navigate('/login')
        }
    })
    return (
      <div>
        <Cmp />
      </div>
    );
  }
export default Protected