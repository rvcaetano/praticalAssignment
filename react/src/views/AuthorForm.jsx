import axiosClient from "../axios-client"
import {useParams, useNavigate} from 'react-router-dom';
import {useEffect, useState} from 'react';
import { useStateContext } from "../../ContextProvider";

export default function AuthorForm(props){
    let {id} = useParams()
    const navigate = useNavigate();
    const [author,setAuthor] = useState({
        id: undefined,
        name: '',
        age: undefined,
        email: '',
        address: '',
        sales: undefined
    })
    const [errors, setErrors] = useState(null)

    if(id){
        useEffect(() => {
            axiosClient.get(`authors/${id}`)
            .then(({data}) => {
                setAuthor(data)
            })
            .catch(() => {

            })
        }, [])   
    }

    const onSubmit = (ev) => {
        ev.preventDefault()
        if(props.formType == 'authorEdit'){
            axiosClient.put(`/authors/${author.id}`, author)
            .then(() => {
                navigate('/')
            })
            .catch(err => {
                const response = err.response;
                if (response && response.status === 422) {
                  setErrors(response.data.errors)
                }
            })
        }
        if(props.formType == 'authorCreate'){
            axiosClient.post(`/authors`, author)
            .then(() => {
                navigate('/')
            })
            .catch(err => {
                const response = err.response;
                if (response && response.status === 422) {
                  setErrors(response.data.errors)
                }
            })
        }

    }
    
    return(
        <div className="container">
            {props.formType=='authorCreate' && <h1>Create Author</h1>}
            {props.formType=='authorEdit' && <h1>Edit Author: {author.name}</h1>}
            {props.formType=='authorView' && <h1>View Author: {author.name}</h1>}

            <div className="card animated fadeInDown">
                <form onSubmit={onSubmit}>
                    <input value={author.name} onChange={ev => setAuthor({...author, name: ev.target.value})} placeholder="Name" readOnly={props.formType === 'authorView'}/>
                    <input value={author.age} onChange={ev => setAuthor({...author, age: ev.target.value})} placeholder="Age" readOnly={props.formType === 'authorView'}/>
                    <input value={author.email} onChange={ev => setAuthor({...author, email: ev.target.value})} placeholder="Email" readOnly={props.formType === 'authorView'}/>
                    <input value={author.address} onChange={ev => setAuthor({...author, address: ev.target.value})} placeholder="Address" readOnly={props.formType === 'authorView'}/>
                    <input value={author.sales} onChange={ev => setAuthor({...author, sales: ev.target.value})} placeholder="Sales" readOnly={props.formType === 'authorView'}/>
                    <button className="btn-save" hidden={props.formType === 'authorView'}>Save</button>
                </form>
            </div>
            
            
        </div>
    )
}