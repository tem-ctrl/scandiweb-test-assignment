'use client';

import React, { ChangeEvent, useState } from 'react';
import { PROPERTY_MAP } from 'app/utils/constants';
import { ProductType, ProductCardProps } from 'app/utils/types';
import useProductContext from 'app/providers/ProductContextProvider';

const ProductCard = ({ sku, name, price, type, property }: ProductCardProps) => {
	const { toDeleteList, addToDeleteList, removeFromDeleteList } = useProductContext();
	const [checked, setChecked] = useState(toDeleteList[type].includes(sku));
	// Set property to be displayed on product card: Size, Weight or Dimensions
	const setCustomProp = (productType: ProductType, value: number | string): string => {
		let [label, unit] = PROPERTY_MAP[productType].cardLabel;

		return `${label} ${value}${unit}`;
	};

	const onChange = (e: ChangeEvent<HTMLInputElement>): void => {
		let isChecked = e.target.checked;

		setChecked(isChecked);

		if (isChecked) {
			addToDeleteList({ type, sku });
		} else {
			removeFromDeleteList({ type, sku });
		}
	};

	return (
		<div className={`${checked ? 'product-checked' : ''} product`}>
			<div className='product-checkbox'>
				<label className='switch' title={checked ? 'Uncheck to avoid deletion' : 'Check to delete'}>
          <span className='sr-only'>{sku}</span>
					<input
						type='checkbox'
						className='delete-checkbox'
            id={sku}
						checked={checked}
						onChange={onChange}
					/>
					<div className='slider' />
				</label>
			</div>
			<div className='product-desc'>
				<p className='product-desc-sku'>{sku}</p>
				<p className='product-desc-name'>{name}</p>
				<p className='product-desc-price'>{price} $</p>
				<p className='product-desc-other'>{setCustomProp(type, property)}</p>
			</div>
		</div>
	);
};

export default ProductCard;
