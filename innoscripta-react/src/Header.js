import {Navbar,Nav,Container, NavDropdown} from "react-bootstrap"
import {Link,useNavigate} from 'react-router-dom'
function Header()
{
    let user =JSON.parse(localStorage.getItem("user-info"))
    
    const navigate= useNavigate();
    function logOut()
    {
        localStorage.clear()
        navigate('/login')
    }
    return(

        <Navbar bg="dark" data-bs-theme="dark">
        <Container>
        <Navbar.Brand href="#home">News Aggregator</Navbar.Brand>
        <Navbar.Toggle aria-controls="navbar-nav" />
        <Navbar.Collapse id="navbar-nav">
            <Nav className="me-auto">
            <Link to="/" className="nav-link">Home</Link>

                {
                    localStorage.getItem("user-info")?
                    <>
                    <Link to="/preference" className="nav-link">Preference List</Link>
                    <Link to="/source" className="nav-link">Source List</Link>
                    <Link to="/news" className="nav-link">News List</Link>
                    
                    </>
                    :
                    <>
                    <Link to="/login" className="nav-link">Login</Link>
                    <Link to="/register" className="nav-link">Register</Link>
                    </>
                }
            
            </Nav>
            {localStorage.getItem("user-info")?
            <Navbar>
                <NavDropdown title={user.data && user.data.email} className="text-light">
                    <NavDropdown.Item className="text-light" onClick={logOut}>Logout</NavDropdown.Item>
                </NavDropdown>
              
            </Navbar>
            :null}
        </Navbar.Collapse>
        </Container>
        </Navbar>



    )
}
export default Header
