import axiosClient from "../axios-client"
import {useParams, useNavigate} from 'react-router-dom';
import {useEffect, useState} from 'react';
import { useStateContext } from "../../ContextProvider";

export default function BookForm(props) {
    let {id} = useParams()
    const navigate = useNavigate();
    const [book,setBook] = useState({
        id: null,
        author_id: null,
        title: '',
        publisher: '',
        published_at: null,
        sales: null
    })
    const [errors, setErrors] = useState(null)

    if(id){
        useEffect(() => {
            axiosClient.get(`books/${id}`)
            .then(({data}) => {
                setBook(data.data)
            })
            .catch(() => {
            })
        }, [])
    }


    const onSubmit = (ev) => {
        ev.preventDefault()
        if(props.formType == 'bookEdit'){
            axiosClient.put(`/books/${book.id}`, book)
            .then(() => {
                navigate('/')
            })
            .catch(err => {
                const response = err.response;
                if (response && response.status === 422) {
                  console.log(response.data.errors)
                }
            })
        }
        if(props.formType == 'bookCreate'){
            console.log(book)
            console.log('creaaaaaaaaaaaate!')
            axiosClient.post(`/books`, book)
            .then(() => {
                navigate('/')
            })
            .catch(err => {
                const response = err.response;
                if (response && response.status === 422) {
                  console.log(response.data.errors)
                }
            })
        }
    }


    return(
        <div className="container">
            {props.formType=='bookCreate' && <h1>Create Book</h1>}
            {props.formType=='bookEdit' && <h1>Edit Book: {book.title}</h1>}
            {props.formType=='bookView' && <h1>View Book: {book.title}</h1>}

            <div className="card animated fadeInDown">
                <form onSubmit={onSubmit}>
                    <input value={book.author_id} onChange={ev => setBook({...book, author_id: ev.target.value})} placeholder="Author ID" readOnly={props.formType === 'bookView'}/>
                    <input value={book.title} onChange={ev => setBook({...book, title: ev.target.value})} placeholder="Title" readOnly={props.formType === 'bookView'}/>
                    <input value={book.publisher} onChange={ev => setBook({...book, publisher: ev.target.value})} placeholder="Publisher" readOnly={props.formType === 'bookView'}/>
                    <input value={book.published_at} onChange={ev => setBook({...book, published_at: ev.target.value})} placeholder="Published At" readOnly={props.formType === 'bookView'}/>
                    <input value={book.sales} onChange={ev => setBook({...book, sales: ev.target.value})} placeholder="Sales" />
                    <button className="btn-save" hidden={props.formType === 'bookView'}>Save</button>
                </form>
            </div>
            
            
        </div>
    )
}