import axios from 'axios';
import {useState} from 'react';
import {useEffect} from 'react';
import axiosClient from '../axios-client.js';
import { useStateContext } from '../../ContextProvider';
import {Link} from 'react-router-dom'

export default function Index(){

    const {user, token} = useStateContext()

    const [authors, setAuthors] = useState([]);
    const [books, setBooks] = useState([]);



    useEffect(() => {
        getAuthors();
        getBooks();
    }, [])

    const onDeleteA = author => {
        if(!window.confirm("Are you sure?")){
            return
        }
        axiosClient.delete(`authors/${author.id}`)
            .then(() =>{
                getAuthors()
            })
            .catch((error) => {
                console.error('Error deleting author:', error);
            });
    }

    const onDeleteB = book => {
        if(!window.confirm("Are you sure?")){
            return
        }
        console.log(book.id)
        axiosClient.delete(`books/${book.id}`)
            .then(() =>{
                getBooks()
            })
    }

    const getAuthors = () => {
        axiosClient.get('authors')
            .then(({data}) => {
                setAuthors(data.data)
            })
            .catch(() => {
            })       
    }

    const getBooks = () => {
        axiosClient.get('books')
            .then(({data}) => {
                setBooks(data.data)
            })
            .catch(() => {
            })
    }
    
    

    
    return(
        <div className='container'>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                <h1>Authors</h1>
                <Link to='/author/new' className='btn-add'>Add Author</Link>
            </div>
            <div className='card animated fadeInDown'>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>AGE</th>
                            <th>EMAIL</th>
                            <th>ADDRESS</th>
                            <th>SALES</th>
                            <th>ACTIONS</th>   
                        </tr>
                    </thead>
                    <tbody>
                        {authors.map(a => (
                            <tr>
                                <td>{a.id}</td>
                                <td><Link to={'/author/show/'+a.id}>{a.name}</Link></td>
                                <td>{a.age}</td>
                                <td>{a.email}</td>
                                <td>{a.address}</td>
                                <td>{a.sales}</td>
                                <td>
                                    <Link to={'/author/edit/'+a.id}><button className='btn-edit'>Edit</button></Link>
                                    &nbsp;
                                    <button className='btn-delete' onClick={ev => onDeleteA(a)} >Delete</button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>

            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginTop: '10%' }}>
                <h1>Books</h1>
                <Link to='/book/new' className='btn-add'>Add Book</Link>
            </div>
            <div className='card animated fadeInDown'>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>AUTHOR</th>
                            <th>TITLE</th>
                            <th>PUBLISHER</th>
                            <th>PUBLISHED AT</th>
                            <th>SALES</th> 
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        {books.map(b => (
                            <tr>
                                <td>{b.id}</td>
                                {authors.map(a => (
                                    a.id === b.author_id ? <td key={a.id}><Link to={'/author/show/'+a.id}>{a.name}</Link></td> : null
                                ))}
                                <td><Link to={'/book/show/'+b.id}>{b.title}</Link></td>
                                <td>{b.publisher}</td>
                                <td>{b.published_at}</td>
                                <td>{b.sales}</td>
                                <td>
                                    <Link to={'/book/edit/'+b.id}><button className='btn-edit'>Edit</button></Link>&nbsp;
                                    <button onClick={ev => onDeleteB(b)} className='btn-delete'>Delete</button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    )
}