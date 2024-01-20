import { createBrowserRouter } from "react-router-dom";
import Index from "./views";
import NotFound from "./Views/NotFound";
import AuthorForm from "./views/AuthorForm";
import BookForm from "./views/BookForm";

const router = createBrowserRouter([
    {
        path: '/',
        element: <Index />,
    },

    {
        path: '/author/new',
        element: <AuthorForm formType="authorCreate" />
    },
    {
        path: '/author/edit/:id',
        element: <AuthorForm formType="authorEdit" />
    },
    {
        path: '/author/show/:id',
        element: <AuthorForm formType="authorView" />
    },


    {
        path: '/book/new',
        element: <BookForm formType="bookCreate" />
    },
    {
        path: '/book/edit/:id',
        element: <BookForm formType="bookEdit" />
    },
    {
        path: '/book/show/:id',
        element: <BookForm formType="bookView" />
    },

    {
        path: '*',
            element: <NotFound />
    }
])

export default router;