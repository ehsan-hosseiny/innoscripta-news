import Header from "./Header"
import React,{useState,useEffect} from "react"
import { Pagination,Table ,Image,Button} from "react-bootstrap"
function News()
{
    const [data, setData] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [lastPage, setLastPage] = useState(1);
    const [search_item,setSearchItem]=useState("")
    
console.log({data})
    useEffect(() => {
        async function fetchData() {
          const user = JSON.parse(localStorage.getItem("user-info"));
          const token = user && user.token;
    
          if (token) {
            try {
              const response = await fetch('http://localhost:8000/api/v1/news', {
                headers: {
                  Authorization: `Bearer ${token}`
                }
              });
    
              if (response.ok) {
                const result = await response.json();
                setData(result.data.data);
                setLastPage(result.data.meta.last_page);               
                
              } else {
                console.error('Error:', response.status);
              }
            } catch (error) {
              console.error('Error:', error);
            }
          }
        }
    
        fetchData();
      }, []);


      

      const handlePageChange = async (page) => {
       
        const user = JSON.parse(localStorage.getItem("user-info"));
        const token = user && user.token;
        try {
          setCurrentPage(page);
          const response = await fetch(
            // `http://localhost:8000/api/v1/news?title=${search_item}&page=${page}`,{
            `http://localhost:8000/api/v1/news?title=${encodeURIComponent(search_item)}&page=${page}`,{
            headers: {
                Authorization: `Bearer ${token}`
                }
            }
          );
          const result = await response.json();
          setData(result.data.data);
          setLastPage(result.data.meta.last_page);   

          setCurrentPage(page);
         
        } catch (error) {
          console.error("Error:", error);
        }
      };

   
 
      const renderPaginationItems = () => {
        const items = [];
        for (let page = 1; page <= lastPage; page++) {
          items.push(
            <Pagination.Item
              key={page}
              active={page === currentPage}
              onClick={() => handlePageChange(page)}
            >
              {page}
            </Pagination.Item>
          );
        }
        return items;
      };





      async function searchNews(key)
      {
       
        const user = JSON.parse(localStorage.getItem("user-info"));
          const token = user && user.token;
    
          if (token) {
            try {
              const response = await fetch('http://localhost:8000/api/v1/news?title='+key, {
                headers: {
                  Authorization: `Bearer ${token}`
                }
              });
    
              if (response.ok) {
                const result = await response.json();
                setData(result.data.data);
                setSearchItem(key);
                setLastPage(result.data.meta.last_page);               
                
              } else {
                console.error('Error:', response.status);
              }
            } catch (error) {
              console.error('Error:', error);
            }
          }
      }




    return (
        <div>
      <Header/>
      <h1>News page</h1>


     <div className="col-sm-4 offset-7">
      <h3>Search box</h3>
      <input type="text" 
      className="form-control"
       placeholder="Search News" 
       onChange={(e)=>searchNews(e.target.value)}
       defaultValue={setSearchItem}
        />
      </div>
      <br/>
  
      
      <Table responsive striped bordered hover size="sm">
        <thead>
          <tr>
            <th>Reference</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Image</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item) => (
            <tr key={item.id}>
              <td>{item.reference}</td>
              <td>{item.title}</td>
              <td>{item.category}</td>
              <td>{item.author}</td>
              <td>
                <Image src={item.image} thumbnail style={{ maxWidth: "100px" }} />
              </td>
            </tr>
          ))}
        </tbody>
      </Table>

      <div>
        
      

        <Pagination className="d-flex justify-content-center mt-4">
          <Pagination.Prev
            disabled={currentPage === 1}
            onClick={() => handlePageChange(currentPage - 1)}
          />
          {renderPaginationItems()}
          <Pagination.Next
            disabled={currentPage === lastPage}
            onClick={() => handlePageChange(currentPage + 1)}
          />
        </Pagination>
      
        
      </div>
    </div>

    )
}
export default News