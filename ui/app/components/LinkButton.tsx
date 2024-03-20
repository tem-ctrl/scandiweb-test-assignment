import React, { FC } from 'react';
import Link from 'next/link';

interface LinkButtonProps {
	className?: string;
	text: string;
	href: string;
	title?: string;
}

const LinkButton: FC<LinkButtonProps> = ({ className = '', text, href, title }) => {
	return (
		<Link className={`${className} button-link link`} href={href} title={title}>
			<button className='button'>{text}</button>
		</Link>
	);
};

export default LinkButton;
