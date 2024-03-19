'use client';

import React, { FC } from 'react';

interface SubmitButtonProps {
	className?: string;
	label: string;
	formName: string;
	id?: string;
	onClick?: (e?: any) => void;
  title?: string;
}

const SubmitButton: FC<SubmitButtonProps> = ({
	className = '',
	label,
	formName,
	id,
  title,
	onClick = () => null,
}) => {
	return (
		<button
			className={`${className} button`}
			id={id}
      title={title}
			type='submit'
			form={formName}
			onClick={onClick}
		>
			{label}
		</button>
	);
};

export default SubmitButton;
