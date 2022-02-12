import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Input, Row } from "antd";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { PriceForm } from "@/Components/Forms/PriceForm/PriceForm";

export default function EditPrice({ price, tankCategories, customerTypes }) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.PRICES_UPDATE, price.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Harga Pengisian", route: routes.PRICES_INDEX },
              { name: "Edit Harga Pengisian" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Edit Harga Pengisian</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <PriceForm
                    name="edit-price"
                    form={form}
                    onFinish={handleFinish}
                    initialValues={price}
                    tankCategories={tankCategories}
                    customerTypes={customerTypes}
                  />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
