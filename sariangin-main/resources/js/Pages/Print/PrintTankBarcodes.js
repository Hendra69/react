import React from "react";
import { Image } from "antd";

export const PrintTankBarcodes = React.forwardRef(({ images }, ref) => {
  return (
    <div ref={ref}>
      {images.map((image, index) => (
        <Image key={index} src={image} />
      ))}
    </div>
  );
});
