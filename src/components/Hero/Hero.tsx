import React from 'react';
import './Hero.css';

export interface HeroProps {
  title: string;
  subtitle?: string;
  imageUrl?: string;
  variant?: 'default' | 'centered' | 'split' | 'background';
  ctaText?: string;
  ctaHref?: string;
  children?: React.ReactNode;
}

export function Hero({
  title,
  subtitle,
  imageUrl,
  variant = 'default',
  ctaText,
  ctaHref,
  children,
}: HeroProps) {
  if (variant === 'centered') {
    return (
      <section className="hero hero--centered">
        <div className="hero__content">
          <h1 className="hero__title">{title}</h1>
          {subtitle && <p className="hero__subtitle">{subtitle}</p>}
          {ctaText && ctaHref && (
            <a className="hero__cta" href={ctaHref}>{ctaText}</a>
          )}
          {children}
        </div>
      </section>
    );
  }
  if (variant === 'split' && imageUrl) {
    return (
      <section className="hero hero--split">
        <div className="hero__content">
          <h1 className="hero__title">{title}</h1>
          {subtitle && <p className="hero__subtitle">{subtitle}</p>}
          {ctaText && ctaHref && (
            <a className="hero__cta" href={ctaHref}>{ctaText}</a>
          )}
          {children}
        </div>
        <div className="hero__image-wrapper">
          <img className="hero__image" src={imageUrl} alt="" />
        </div>
      </section>
    );
  }
  if (variant === 'background' && imageUrl) {
    return (
      <section className="hero hero--background" style={{ backgroundImage: `url(${imageUrl})` }}>
        <div className="hero__overlay">
          <div className="hero__content">
            <h1 className="hero__title">{title}</h1>
            {subtitle && <p className="hero__subtitle">{subtitle}</p>}
            {ctaText && ctaHref && (
              <a className="hero__cta" href={ctaHref}>{ctaText}</a>
            )}
            {children}
          </div>
        </div>
      </section>
    );
  }
  // Default variant
  return (
    <section className="hero">
      <div className="hero__content">
        <h1 className="hero__title">{title}</h1>
        {subtitle && <p className="hero__subtitle">{subtitle}</p>}
        {ctaText && ctaHref && (
          <a className="hero__cta" href={ctaHref}>{ctaText}</a>
        )}
        {children}
      </div>
    </section>
  );
} 