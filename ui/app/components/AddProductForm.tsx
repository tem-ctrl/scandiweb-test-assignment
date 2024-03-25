'use client';

import React, { FC, FormEvent, useEffect, useState } from 'react';
import { Product, ProductType } from 'app/utils/types';
import FormTextInput from 'app/components/FomTextInput';
import SelectProductType from 'app/components/SelectProductType';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import { toast } from 'react-toastify';
import { API } from 'app/config/api';
import useSWR from 'swr';
import { TOAST_OPTIONS } from 'app/utils/constants';
import { sanitizeData } from 'app/utils';
import { PAGES } from 'app/config/routes';
import axios from 'axios';
import { useRouter } from 'next/navigation';
import {
	AddProductFormFields,
	addProductFormSchema,
	setDefaultFormValues,
} from 'app/utils/resolvers';

interface AddProductFormProps {
	className?: string;
	skus?: string[];
}

const AddProductForm: FC<AddProductFormProps> = ({ className = '' }) => {
	const [productType, setProductType] = useState<ProductType>('dvd');
	const { data: products, isLoading } = useSWR<Product[]>(API.getProducts);
	const [defaultValues, setDefaultValues] = useState({});
	const [skuError, setSkuError] = useState(false);
	const router = useRouter();
	const { register, getValues } = useForm<AddProductFormFields>({
		defaultValues: defaultValues,
		resolver: yupResolver(addProductFormSchema),
	});

	const notify = (message: string): void => {
		toast.error(message, TOAST_OPTIONS);
		toast.clearWaitingQueue();
	};

	// Generate default values on product type change
	useEffect(() => setDefaultValues(setDefaultFormValues(productType)), [productType]);

	const onSubmit = (event: FormEvent<HTMLFormElement>) => {
		event.preventDefault();
		let sku = getValues()['sku'];

		if (!isLoading) {
			let skus = products ? products.map((elt: Product) => elt.sku) : [];
			let submitData = sanitizeData(getValues());

			addProductFormSchema
				.validate(submitData)
				.then(() => {
					if (skus.includes(sku)) {
						setSkuError(true);

						return;
					}
					setSkuError(false);
					axios
						.post( API.addProduct, submitData,
							{
								headers: { 'Content-Type': 'multipart/form-data' },
							}
						)
						.then(() => {
							router.push(PAGES.home);
						})
						.catch((error) => console.error(error));
				})
				.catch((err) => {
					notify(err.message);
				});
		}
	};

	return (
		<form onSubmit={onSubmit} id='product_form' className={className}>
			<p className='required'>All fields are required !</p>
			<FormTextInput
				{...register('sku')}
        id='sku'
				label='SKU'
				placeholder='Enter product SKU'
				error={skuError ? 'sku value taken, choose a different one' : ''}
				mandatory
			/>
			<FormTextInput
				{...register('name')}
        id='name'
				label='Name'
				placeholder='Enter product name'
				mandatory
			/>
			<FormTextInput
				{...register('price')}
				label='Price ($)'
        id='price'
				placeholder='Enter product price'
				type='number'
				step='any'
				mandatory
			/>
			<SelectProductType
				productType={productType}
				setProductType={setProductType}
				{...register('type')}
        id='productType'
			/>
			{productType === 'dvd' && (
				<FormTextInput
					{...register('size')}
					label='Size (MB)'
					id='size'
					type='number'
					step='any'
					mandatory
				/>
			)}
			{productType === 'book' && (
				<FormTextInput
					{...register('weight')}
					label='Weight (kg)'
					id='weight'
					type='number'
					step='any'
					mandatory
				/>
			)}
			{productType === 'furniture' && (
				<>
					<FormTextInput
						{...register('height')}
						label='Height (CM)'
						id='height'
						type='number'
						step='any'
						mandatory
					/>
					<FormTextInput
						{...register('width')}
						label='Width (CM)'
						id='width'
						type='number'
						step='any'
						mandatory
					/>
					<FormTextInput
						{...register('length')}
						label='Length (CM)'
						id='length'
						type='number'
						step='any'
						mandatory
					/>
				</>
			)}
		</form>
	);
};

export default AddProductForm;
