import React from 'react';
import { FaGithub, FaLinkedin, FaWhatsapp } from 'react-icons/fa';
import { TbWorld } from 'react-icons/tb';
import Link from 'next/link';

type FooterLink = {
	href: string;
	icon: React.ReactNode;
  title: string;
};

const FooterItem = ({ href, icon, title }: FooterLink) => {
	return (
		<Link href={href} target='_blank' className='footer-link' title={title}>
			<span className='footer-icon'>{icon}</span>
      <span className='sr-only'>{title}</span>
		</Link>
	);
};

const Footer = () => {
	const footerLinks: FooterLink[] = [
		{
			href: 'https://linkedin.com/in/temgoua',
			icon: <FaLinkedin />,
      title: 'Contact me on linkedin',
		},
		{
			href: 'https://github.com/tem-ctrl',
			icon: <FaGithub />,
      title: 'See my github profile',
		},
		{
			href: 'https://wa.me/237651331062',
			icon: <FaWhatsapp />,
      title: 'Text me on whatsapp',
		},
		{
			href: 'https://gtemgoua.vercel.app',
			icon: <TbWorld />,
      title: 'My portfolio',
		},
	];

	return (
		<footer className='footer'>
			<h2 className='footer-title'>Scandiweb Test Assignment</h2>
			<div className='footer-links'>
				{footerLinks.map((item, i) => (
					<FooterItem key={`footer-link-${i}`} {...item} />
				))}
			</div>
			<p className='footer-copyright'>© {new Date().getFullYear()} Gilbert Temgoua</p>
		</footer>
	);
};

export default Footer;
