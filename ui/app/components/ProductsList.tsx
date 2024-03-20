'use client';

import React, { FC } from 'react';
import LinkButton from '@/app/components/LinkButton';
import ProductCard from '@/app/components/ProductCart';
import { API } from '@/app/config/api';
import { PAGES } from '@/app/config/routes';
import { prepareData } from '@/app/utils/data';
import { Product } from '@/app/utils/types';
import useSWR from 'swr';

interface ProductsListProps {
	className?: string;
}

const ProductsList: FC<ProductsListProps> = ({ className = '' }) => {
	const { data: products } = useSWR<Product[]>(API.getProducts);

	return (
		<main className={`${className} main home`}>
			{products ? (
				<>
					{products.length > 0 ? (
						products
							.map(prepareData)
							.map((product) => <ProductCard key={product.sku} {...product} />)
					) : (
						<div className='home-empty'>
							<h2 className='home-empty-title'>No product found !</h2>
							<LinkButton text='Add New Product' href={PAGES.addProduct} />
						</div>
					)}
				</>
			) : null}
		</main>
	);
};

export default ProductsList;
