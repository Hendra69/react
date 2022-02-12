import React, { useEffect } from "react";
import { Button, Col, Form, Input, InputNumber, Row, Select } from "antd";
import axios from "axios";
import { routes } from "@/routes";
import { usePage } from "@inertiajs/inertia-react";

export const PriceForm = ({
  children,
  form,
  initialValues,
  name,
  onFinish,
  tankCategories,
  customerTypes,
}) => {
  const { errors } = usePage().props;

  useEffect(() => {
    form.setFields(
      Object.keys(errors).map((field) => ({
        name: field,
        errors: [errors[field]],
      }))
    );
  }, [errors]);

  return (
    <Form
      layout="vertical"
      form={form}
      name={name}
      initialValues={initialValues}
      onFinish={onFinish}
    >
      <Row gutter={[32, 32]}>
        <Col span={12}>
          <Form.Item
            name="tank_category_id"
            label="Kategori Tabung"
            rules={[{ required: true, message: "Kategori tabung dibutuhkan" }]}
          >
            <Select
              showSearch
              options={tankCategories}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>

          <Form.Item
            name="customer_type"
            label="Jenis Pelanggan"
            rules={[
              { required: true, message: "Jenis pelanggan dibutuhkan" },
              // ({ getFieldValue }) => ({
              //   validator(_, value) {
              //     if (value && getFieldValue("tank_category_id")) {
              //       const url = initialValues?.id
              //         ? route(routes.PRICES_AJAX_CHECK_UNIQUE, initialValues.id)
              //         : route(routes.PRICES_AJAX_CHECK_UNIQUE);

              //       return axios
              //         .post(url, {
              //           tank_category_id: getFieldValue("tank_category_id"),
              //           customer_type: value,
              //         })
              //         .then(() => Promise.resolve())
              //         .catch(() =>
              //           Promise.reject(
              //             new Error(
              //               "Harga untuk kategori tabung dan jenis pelanggan ini sudah ada."
              //             )
              //           )
              //         );
              //     }
              //     return Promise.resolve();
              //   },
              // }),
            ]}
          >
            <Select
              options={customerTypes}
              optionFilterProp="label"
              optionLabelProp="label"
            />
          </Form.Item>
        </Col>

        <Col span={12}>
          <Form.Item
            name="price"
            label="Harga per Tabung"
            rules={[{ required: true, message: "Harga per tabung dibutuhkan" }]}
          >
            <InputNumber
              addonBefore="Rp"
              min={0}
              formatter={(value) => value.replace(/\B(?=(\d{3})+(?!\d))/g, ".")}
              parser={(value) => value.replace(/\$\s?|(\.*)/g, "")}
            />
          </Form.Item>

          {children}
        </Col>
      </Row>

      <Form.Item>
        <Button type="primary" htmlType="submit">
          Submit
        </Button>
      </Form.Item>
    </Form>
  );
};
