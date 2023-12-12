import Header from "./Header"
import React,{useState,useEffect} from "react"
import { Table ,Image,Button} from "react-bootstrap"
import { getDefaultNormalizer } from "@testing-library/react";
function Preference()
{
    const [data, setData] = useState([]);
    
    
    useEffect(() => {
      fetchData();
    }, []);


    async function fetchData() {
      const user = JSON.parse(localStorage.getItem("user-info"));
      const token = user && user.token;
  
      if (token) {
        try {
          const response = await fetch("http://localhost:8000/api/v1/preferences", {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
  
          if (response.ok) {
            const result = await response.json();
            setData(result.data);
          } else {
            console.error("Error:", response.status);
          }
        } catch (error) {
          console.error("Error:", error);
        }
      }
    }



      async function deletePreference(id) {
        const user = JSON.parse(localStorage.getItem("user-info"));
        const token = user && user.token;
    
        if (token) {
          try {
            const response = await fetch(`http://localhost:8000/api/v1/preferences/${id}`, {
              headers: {
                Authorization: `Bearer ${token}`,
              },
              method: "DELETE",
            });
    
            if (response.ok) {
              const result = await response.json();
              fetchData(); // Call fetchData to update the data after deletion
            } else {
              console.error("Error:", response.status);
            }
          } catch (error) {
            console.error("Error:", error);
          }
        }
      }

    




    return (
        <div>
      <Header/>
      <h1>Preference page</h1>
      
      <Table responsive striped bordered hover size="sm">
        <thead>
          <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Preference</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr key={item.id}>
              <td>{item.id}</td>
              <td>{item.type}</td>
              <td>{item.preference}</td>
              <td><Button onClick={()=>deletePreference(item.id)} variant="outline-danger">Delete from Preference</Button></td>
              
            </tr>
          ))}
        </tbody>
      </Table>

      <div>
        
      

      
        
      </div>
    </div>

    )
}
export default Preference