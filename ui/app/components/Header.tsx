'use client';

import React, { FC } from 'react';
import { PAGES } from 'app/config/routes';
import LinkButton from 'app/components/LinkButton';
import SubmitButton from 'app/components/SubmitButton';
import useProductContext from 'app/providers/ProductContextProvider';

interface HeaderProps {
  isHome?: boolean;
}

const Header: FC<HeaderProps> = ({ isHome = false }) => {
	const { massDelete } = useProductContext();

	return (
		<header className='header'>
			<h1 className='h1 header-title'>{isHome ? 'Product List' : 'Add Product'}</h1>
			<div className='header-buttons'>
				{isHome ? (
					<>
						<LinkButton text='ADD' title='Add new product' href={PAGES.addProduct} />
						<SubmitButton
							id='delete-product-btn'
							label='MASS DELETE'
							formName=''
							onClick={massDelete}
              title='Delete selected products'
						/>
					</>
				) : (
					<>
						<SubmitButton label='Save' title='Save product' formName='product_form' />
						<LinkButton text='Cancel' title='Cancel process' href={PAGES.home} />
					</>
				)}
			</div>
		</header>
	);
};

export default Header;
