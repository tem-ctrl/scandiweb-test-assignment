'use client';

import React, { FC } from 'react';

interface SubmitButtonProps {
	className?: string;
	label: string;
	formName: string;
	id?: string;
	onClick?: (e?: any) => void;
}

const SubmitButton: FC<SubmitButtonProps> = ({
	className = '',
	label,
	formName,
	id = '',
	onClick = () => null,
}) => {
	return (
		<button
			className={`${className} button`}
			id={id}
			type='submit'
			form={formName}
			onClick={onClick}
		>
			{label}
		</button>
	);
};

export default SubmitButton;
