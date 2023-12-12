import Header from "./Header"
import React,{useState,useEffect} from "react"
import { Row, Col, Form,Alert } from 'react-bootstrap';
function Source()
{
    const [authors, setAuthors] = useState([]);
    const [references, setReferences] = useState([]);
    const [categories, setCategories] = useState([]);
    
    
    // useEffect(() => {
    //   fetchData();
    // }, []);

    useEffect(() => {
      const fetchData = async () => {
        const user = JSON.parse(localStorage.getItem("user-info"));
        const token = user && user.token;
    
        if (token) {
          try {
            const response = await fetch("http://localhost:8000/api/v1/sources", {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            });
    
            if (response.ok) {
              const data = await response.json();
              
              const authorsData = [...new Map(data.data.authors.map(item => [item.author, item])).values()];
             
              setAuthors(authorsData);

              const referenceData = [...new Map(data.data.references.map(item => [item.reference, item])).values()];
              setReferences(referenceData);

              const categoryData = [...new Map(data.data.categories.map(item => [item.category, item])).values()];
              setCategories(categoryData);
            } else {
              console.error("Error:", response.status);
            }
          } catch (error) {
            console.error("Error:", error);
          }
        }
      };
    
      fetchData();
    }, []);

   
    // const handleCheckboxChange = (id, itemType) => {
    //   // Remove the item from the respective list based on the id and itemType
    //   if (itemType === 'author') {
    //     setAuthors(authors.filter(author => author.id !== id));
    //   } else if (itemType === 'source') {
    //     setReferences(references.filter(reference => reference.id !== id));
    //   } else if (itemType === 'category') {
    //     setCategories(categories.filter(category => category.id !== id));
    //   }
    // };


    async function handleCheckboxChange(itemId,itemValue, type) {
      const user = JSON.parse(localStorage.getItem("user-info"));
      
      const item = {
        'type': type,
        'preference': itemValue
      };
      
    console.warn(JSON.stringify(item));
      try {
        const response = await fetch("http://localhost:8000/api/v1/preferences", {
          method: "POST",
          body: JSON.stringify(item),
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${user.token}`
          }
        });
    
        const result = await response.json();
        setSuccess({ message: result.message, className: 'alert-success' });
        setTimeout(() => {
          setSuccess(null);
        }, 1000); // Set the duration in milliseconds


        if (type === "author") {
          setAuthors(authors.filter(author => author.id !== itemId));
        } else if (type === "source") {
          setReferences(references.filter(reference => reference.id !== itemId));
        } else if (type === "category") {
          setCategories(categories.filter(category => category.id !== itemId));
        }
     
     

      
        // Process the result as needed
      } catch (error) {
        console.error("Error:", error);
      }
    }

    const [success, setSuccess] = useState('');




    return (
      <div>
        <Header/>
        <div>
        {success && (
        <Alert variant={success.className}>
          {success.message}
        </Alert>
      )}
     
    </div>
    <Row>
  <Col>
    <h1>Authors</h1>
    <Form>
      {authors.map((author) => (
        <Form.Group key={author.id}>
          <Form.Check
            type="checkbox"
            id={author.id}
            label={author.author}
            onChange={() => handleCheckboxChange(author.id,author.author, 'author')}
          />
        </Form.Group>
      ))}
    </Form>
  </Col>

  <Col>
    <h1>References</h1>
    <Form>
    {references.map((reference) => (
        <Form.Group key={reference.id}>
          <Form.Check
            type="checkbox"
            id={reference.id}
            label={reference.reference}
            onChange={() => handleCheckboxChange(reference.id,reference.reference, 'source')}
          />
        </Form.Group>
      ))}

     
    </Form>
  </Col>

  <Col>
    <h1>Categories</h1>
    <Form>
      {categories.map((category) => (
        <Form.Group key={category.id}>
          <Form.Check
            type="checkbox"
            id={category.id}
            label={category.category}
            onChange={() => handleCheckboxChange(category.id,category.category, 'category')}
          />
        </Form.Group>
      ))}
    </Form>
  </Col>
</Row>
    </div>

    )
}
export default Source