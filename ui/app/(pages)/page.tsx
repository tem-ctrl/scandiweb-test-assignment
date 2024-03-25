import { Metadata, NextPage } from 'next';
import ProductsList from 'app/components/ProductsList';
import Header from 'app/components/Header';

const HomePage: NextPage = () => {
  return (
    <>
      <Header isHome />
      <ProductsList />
    </>
  )
};

export default HomePage;

export const metadata: Metadata = {
	title: 'Home - Scandiweb Junior Developer Test Assignment',
	description: `Products store by Gilbert Temgoua for the Scandiweb Junior Developer position application.
  This web app is built with NextJs, TypeScript, Sass, PHP, MySQL
  `,
};
