import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import './App.css';
import HomePage from '../page/home';
import ProductPage from '../page/Product';
import CobaPage from '../page/Coba';

const route = createBrowserRouter([
  {
    path: '/',
    element: <HomePage />,
  },
  {
    path: '/product/:id',
    element: <ProductPage />,
  },
  {
    path: '/coba/',
    element: <CobaPage />,
  },
  {
    path: '/product',
    element: <h1>Product</h1>,
  },
]);

function App() {
  return <RouterProvider router={route} />;
}

export default App;
