import { Link } from "@inertiajs/inertia-react";
import React from "react";

export const MenuLogo = (props) => {
  return (
    <Link
      href="/"
      className="da-d-flex da-align-items-end"
      onClick={props.onClose}
    >
      <img className="da-logo" src="/storage/assets/logo.png" alt="logo" />

      <span
        className="h3 d-font-weight-800 da-text-color-primary-1 da-mb-6"
        style={{ marginLeft: 12 }}
      >
        Sari Angin
      </span>
    </Link>
  );
};
