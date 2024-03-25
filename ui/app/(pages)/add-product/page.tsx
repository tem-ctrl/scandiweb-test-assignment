import AddProductForm from 'app/components/AddProductForm';
import Header from 'app/components/Header';
import { Metadata, NextPage } from 'next';

const AddProductPage: NextPage = () => {
	return (
    <>
      <Header />
      <main className='main addproduct'>
        <AddProductForm />
      </main>
    </>
	);
};

export default AddProductPage;

export const metadata: Metadata = {
	title: 'Add Product - Scandiweb Assigntment Test',
	description: `We can add 3 different types of products:
  Books, DVDs or Furnitures. The form management and validation are handled with react-hook-form and yup resolver. 
  `,
};
