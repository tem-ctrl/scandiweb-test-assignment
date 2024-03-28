'use client';

import React, { FC } from 'react';
import LinkButton from 'app/components/LinkButton';
import ProductCard from 'app/components/ProductCart';
import { API } from 'app/config/api';
import { PAGES } from 'app/config/routes';
import { prepareData } from 'app/utils/data';
import { Product } from 'app/utils/types';
import useSWR from 'swr';


const ProductsList: FC = () => {
	const { data: products, isLoading } = useSWR<Product[]>(API.getProducts);

  if (!products || isLoading || !Array.isArray(products)) return <main className='main home'></main>;

	return (
		<main className='main home'>
      {products.length > 0 ? (
        products
          .map(prepareData)
          .map((p) => <ProductCard key={p.sku} {...p} />)
      ) : (
        <div className='home-empty'>
          <h2 className='home-empty-title'>No products found !</h2>
          <LinkButton text='Add New Product' href={PAGES.addProduct} />
        </div>
      )}
		</main>
	);
};

export default ProductsList;
