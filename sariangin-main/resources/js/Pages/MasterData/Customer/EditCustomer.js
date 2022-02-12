import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Input, Row } from "antd";
import { routes } from "@/routes";
import { CustomerForm } from "@/Components/Forms/CustomerForm/CustomerForm";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";

export default function EditCustomer({ customer, customerTypes }) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.CUSTOMERS_UPDATE, customer.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Data Pelanggan", route: routes.CUSTOMERS_INDEX },
              { name: "Ubah Pelanggan" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Ubah Pelanggan</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <CustomerForm
                    name="create-customer"
                    form={form}
                    onFinish={handleFinish}
                    customerTypes={customerTypes}
                    initialValues={customer}
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
